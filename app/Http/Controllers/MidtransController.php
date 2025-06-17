<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
class MidtransController extends Controller
{

    public function pay($id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $pembayaran = Pembayaran::findOrFail($id);

        // Buat order_id unik
        $orderId = 'ORDER-' . Str::uuid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $pembayaran->jumlah,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name ?? 'Anon',
                'email' => auth()->user()->email ?? 'test@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Simpan transaksi
        $transaction = Transaction::create([
            'order_id' => $orderId,
            'amount' => $pembayaran->jumlah,
            'status' => 'pending',
            'pembayaran_id' => $pembayaran->id,
        ]);
        $transaction->pembayarans()->attach($pembayaran->id);

        return view('midtrans.pay', compact('snapToken'));
    }
    public function bulkPay(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $ids = $request->input('ids', []);

        $pembayarans = Pembayaran::whereIn('id', $ids)
            ->where('status', 'menunggu')
            ->get();

        if ($pembayarans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pembayaran yang valid untuk diproses.');
        }

        // Gabungkan data
        $totalAmount = $pembayarans->sum('jumlah');
        $deskripsi = $pembayarans->pluck('jenis_pembayaran')->implode(', ');
        $pembayaranIds = $pembayarans->pluck('id')->toArray();

        $orderId = 'ORDER-' . Str::uuid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalAmount,
            ],
            'item_details' => $pembayarans->map(function ($item) {
                return [
                    'id' => $item->id,
                    'price' => $item->jumlah,
                    'quantity' => 1,
                    'name' => $item->jenis_pembayaran,
                ];
            })->toArray(),
            'customer_details' => [
                'first_name' => auth()->user()->name ?? 'Anon',
                'email' => auth()->user()->email ?? 'test@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Simpan ke transaksi
        $transaction = Transaction::create([
            'order_id' => $orderId,
            'amount' => $totalAmount,
            'status' => 'pending',
            'keterangan' => $deskripsi,
        ]);

        $transaction->pembayarans()->attach($pembayaranIds);


        return view('midtrans.pay', compact('snapToken'));
    }

    public function callback(Request $request)
    {
        $payload = json_decode($request->getContent());

        $transaction = Transaction::where('order_id', $payload->order_id)->first();

        if ($transaction) {
            $transaction->update([
                'status' => $payload->transaction_status,
                'payment_type' => $payload->payment_type,
                'transaction_time' => $payload->transaction_time,
                'transaction_id' => $payload->transaction_id,
            ]);

            // Update pembayaran sesuai amount
            $pembayaran = Pembayaran::where('jumlah', $transaction->amount)
                ->where('status', 'menunggu')
                ->latest()
                ->first();

            if ($pembayaran) {
                $pembayaran->update([
                    'status' => $payload->transaction_status === 'settlement' ? 'berhasil' : 'menunggu',
                    'tanggal_bayar' => now(),
                ]);
            }
        }

        return response()->json(['message' => 'OK']);
    }
    public function updateStatus(Request $request)
    {
        $orderId = $request->query('order_id');
        $status = $request->query('transaction_status'); // gunakan sesuai midtrans
        $pdfUrl = $request->query('pdf_url');
        $transactionId = $request->query('transaction_id');
        $paymentType = $request->query('payment_type');
        $grossAmount = $request->query('gross_amount');
        $fraudStatus = $request->query('fraud_status');
        $transactionTime = $request->query('transaction_time');
        $bank = $request->query('bank');
        $vaNumber = $request->query('va_number');

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return redirect('/user/pembayarans')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Update data transaksi
        $transaction->update([
            'status' => $status,
            'pdf_url' => $pdfUrl,
            'transaction_id' => $transactionId,
            'amount' => $grossAmount,
            'payment_type' => $paymentType,
            'fraud_status' => $fraudStatus,
            'transaction_time' => $transactionTime ?? now(),
            'bank' => $bank,
            'va_number' => $vaNumber,
        ]);

        // Update pembayaran terkait jika ada
        $pembayarans = $transaction->pembayarans; // relasi belongsToMany

        foreach ($pembayarans as $pembayaran) {
            $pembayaran->update([
                'status' => $status === 'settlement' ? 'berhasil' : 'menunggu',
                'tanggal_bayar' => now(),
            ]);
        }


        return redirect('/user/pembayarans')->with('success', 'Transaksi berhasil diperbarui.');
    }
}
