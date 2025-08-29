<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\MidtransController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/form-pendaftaran', [PendaftaranController::class, 'index'])->name('form-pendaftaran');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
Route::get('/export-santri', [SantriController::class, 'exportCsv']);
Route::get('/export-santri/{user_id}', [SantriController::class, 'exportSantriDetail']);
Route::get('/export-transaksi', [SantriController::class, 'exportCsvTransaksi']);
Route::get('/export-transaksi/{user_id}', [SantriController::class, 'exportCsvTransaksi']);

// Export PDF routes
Route::get('/export-santri-pdf', [SantriController::class, 'exportPdf']);
Route::get('/export-santri/{user_id}/pdf', [SantriController::class, 'exportSantriDetailPdf']);
Route::get('/export-transaksi-pdf', [SantriController::class, 'exportPdfTransaksi']);
Route::get('/export-transaksi-pdf/{user_id}', [SantriController::class, 'exportPdfTransaksi']);

//pembayaran midtrans
Route::get('/bayar/{pembayaran_id}', [MidtransController::class, 'pay'])->name('midtrans.pay');
Route::get('/user_pembayaran', [MidtransController::class, 'updateStatus']);
Route::get('/bulk-pay', [MidtransController::class, 'bulkPay'])->name('midtrans.bulkPay');

//VERIFY EMAIL
// web.php
Route::get('/verifikasi/{token}', [PendaftaranController::class, 'formPassword']);
Route::post('/verifikasi/{token}', [PendaftaranController::class, 'setPassword']);
use App\Models\Pengumuman;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/rekapan-penerimaan', function () {
    $pengumuman = Pengumuman::with('user')->get();
    $tanggalCetak = now()->translatedFormat('d F Y');
    $pengasuh = 'KH. Salman Alfarizi'; // Bisa diambil dari DB

    $pdf = Pdf::loadView('rekapan.penerimaan', [
        'pengumuman' => $pengumuman,
        'tanggalCetak' => $tanggalCetak,
        'pengasuh' => $pengasuh,
    ])->setPaper('A4', 'portrait');

    return $pdf->stream('rekapan-penerimaan.pdf');
});

Route::get('user/login',fn () => 'Halo login')->name('login');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', fn () => 'Halo Admin');
});

Route::middleware(['role:superadmin'])->group(function () {
    Route::get('/superadmin', fn () => 'Halo Superadmin');
});

Route::middleware(['role:user'])->group(function () {
    Route::get('/user', fn () => 'Halo User');
});
Route::middleware(['role:user,admin,superadmin'])->group(function () {
    Route::get('/user/login', fn () => 'Admin & Superadmin bisa lihat ini');
});


require __DIR__.'/auth.php';
