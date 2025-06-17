<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;

class MidtransController extends Controller
{
    public function pay()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $order_id = 'ORDER-' . uniqid();
        $amount = 100000;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => 'Rizky',
                'email' => 'rizky@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Simpan ke DB
        Transaction::create([
            'order_id' => $order_id,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        return view('midtrans.pay', compact('snapToken'));
    }

    public function callback(Request $request)
    {
        $payload = json_decode($request->getContent());

        $order = Transaction::where('order_id', $payload->order_id)->first();

        if ($order) {
            $order->update([
                'status' => $payload->transaction_status,
                'payment_type' => $payload->payment_type,
                'transaction_time' => $payload->transaction_time,
                'transaction_id' => $payload->transaction_id,
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}
