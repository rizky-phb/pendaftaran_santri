<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class SantriController extends Controller
{
    public function exportCsv()
    {
        $santri = User::query()
            ->where('role', 'user')
            ->with(['santri', 'ortu', 'berkas'])
            ->get();

        $filename = "santri.csv";
        $handle = fopen('php://temp', 'r+');

        // Header
        fputcsv($handle, [
            'Nama',
            'Email',
            'Nama Lengkap',
            'NISN',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Agama',
            'Jenis Kelamin',
            'Alamat',
            'Nama Ayah',
            'NIK Ayah',
            'Pendidikan Terakhir Ayah',
            'Pekerjaan Ayah',
            'No HP Ayah',
            'Nama Ibu',
            'NIK Ibu',
            'Pendidikan Terakhir Ibu',
            'Pekerjaan Ibu',
            'No HP Ibu',
            'Status Verifikasi',
        ]);

        // Data
        foreach ($santri as $s) {
            fputcsv($handle, [
                $s->name,
                $s->email,
                $s->santri->nama_lengkap ?? '',
                $s->santri->nisn ?? '',
                $s->santri->tanggal_lahir ?? '',
                $s->santri->tempat_lahir ?? '',
                $s->santri->agama ?? '',
                $s->santri->jenis_kelamin ?? '',
                $s->santri->alamat ?? '',
                $s->ortu->nama_ayah ?? '',
                $s->ortu->nik_ayah ?? '',
                $s->ortu->pendidikan_terakhir_ayah ?? '',
                $s->ortu->pekerjaan_ayah ?? '',
                $s->ortu->no_hp_ayah ?? '',
                $s->ortu->nama_ibu ?? '',
                $s->ortu->nik_ibu ?? '',
                $s->ortu->pendidikan_terakhir_ibu ?? '',
                $s->ortu->pekerjaan_ibu ?? '',
                $s->ortu->no_hp_ibu ?? '',
                $s->berkas->status ?? ''
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }
    public function exportCsvTransaksi($userId = null)
{
    // Ambil transaksi yang status-nya 'settlement' saja
    $query = Transaction::where('status', 'settlement')
        ->with(['pembayarans.user']);

    // Jika user_id ditentukan, filter berdasarkan itu
    if ($userId) {
        $query->whereHas('pembayarans', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    $transactions = $query->get();

    $filename = "transaksi_berhasil.csv";
    $handle = fopen('php://temp', 'r+');

    // Header kolom CSV
    fputcsv($handle, [
        'User ID',
        'Nama User',
        'Jenis Pembayaran',
        'Jumlah',
        'Order ID',
        'Status',
        'Metode Pembayaran',
        'Waktu Transaksi',
        'Bank',
        'VA Number',
        'PDF URL',
    ]);

    foreach ($transactions as $trx) {
        foreach ($trx->pembayarans as $pembayaran) {
            $user = $pembayaran->user;

            fputcsv($handle, [
                $user->id ?? '',
                $user->name ?? '',
                $pembayaran->jenis_pembayaran ?? '',
                $pembayaran->jumlah ?? '',
                $trx->order_id ?? '',
                $trx->status ?? '',
                $trx->payment_type ?? '',
                $trx->transaction_time ?? '',
                $trx->bank ?? '',
                $trx->va_number ?? '',
                $trx->pdf_url ?? '',
            ]);
        }
    }

    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);

    return response($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=$filename",
    ]);
}


    public function exportSantriDetail($user_id){
        $santri = User::query()
        ->where('role', 'user')
        ->where('id', $user_id)
        ->with(['santri', 'ortu', 'berkas'])
        ->get();

        $firstSantri = $santri->first();
        $name = $firstSantri && $firstSantri->santri ? $firstSantri->santri->nama_lengkap : '';
        $filename = "Data " . $name . ".csv";
        $handle = fopen('php://temp', 'r+');

    // Header
    fputcsv($handle, [
        'Nama',
        'Email',
        'Nama Lengkap',
        'NISN',
        'Tanggal Lahir',
        'Tempat Lahir',
        'Agama',
        'Jenis Kelamin',
        'Alamat',
        'Nama Ayah',
        'NIK Ayah',
        'Pendidikan Terakhir Ayah',
        'Pekerjaan Ayah',
        'No HP Ayah',
        'Nama Ibu',
        'NIK Ibu',
        'Pendidikan Terakhir Ibu',
        'Pekerjaan Ibu',
        'No HP Ibu',
        'Status Verifikasi',
    ]);

    // Data
    foreach ($santri as $s) {
        fputcsv($handle, [
            $s->name,
            $s->email,
            $s->santri->nama_lengkap ?? '',
            $s->santri->nisn ?? '',
            $s->santri->tanggal_lahir ?? '',
            $s->santri->tempat_lahir ?? '',
            $s->santri->agama ?? '',
            $s->santri->jenis_kelamin ?? '',
            $s->santri->alamat ?? '',
            $s->ortu->nama_ayah ?? '',
            $s->ortu->nik_ayah ?? '',
            $s->ortu->pendidikan_terakhir_ayah ?? '',
            $s->ortu->pekerjaan_ayah ?? '',
            $s->ortu->no_hp_ayah ?? '',
            $s->ortu->nama_ibu ?? '',
            $s->ortu->nik_ibu ?? '',
            $s->ortu->pendidikan_terakhir_ibu ?? '',
            $s->ortu->pekerjaan_ibu ?? '',
            $s->ortu->no_hp_ibu ?? '',
            $s->berkas->status ?? ''
        ]);
    }

    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);

    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=$filename",
    ]);
    }

        public function exportPdf()
        {
            $santri = User::query()
                ->where('role', 'user')
                ->with(['santri', 'ortu', 'berkas'])
                ->get();

            $pdf = Pdf::loadView('exports.santri-pdf', compact('santri'))
                ->setPaper('a4', 'landscape');
            return $pdf->download('santri.pdf');
        }
        public function exportPdfTransaksi($userId = null)
{
    $query = Transaction::where('status', 'settlement')->with(['pembayarans.user']);

    if ($userId) {
        $query->whereHas('pembayarans', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    $transactions = $query->get();

    $pdf = Pdf::loadView('exports.transaksi-pdf', compact('transactions'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('transaksi_berhasil.pdf');
}
    public function exportSantriDetailPdf($user_id)
    {
        $santri = User::query()
            ->where('role', 'user')
            ->where('id', $user_id)
            ->with(['santri', 'ortu', 'berkas'])
            ->first();

        $pdf = Pdf::loadView('exports.santri-detail-pdf', compact('santri'));
        $filename = 'Data ' . ($santri->santri->nama_lengkap ?? 'santri') . '.pdf';
        return $pdf->download($filename);
    }

}
