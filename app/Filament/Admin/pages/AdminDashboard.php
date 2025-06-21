<?php

namespace App\Filament\Admin\Pages;

use App\Models\User;
use App\Models\DataSantri;
use App\Models\DataOrtu;
use App\Models\UploadBerkas;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'livewire.admin.pages.dashboard';

    public function mount(): void
    {
        $this->totalPendaftar = Pendaftaran::count();
        $this->verifikasiEmail = Pendaftaran::whereNotNull('email_verified_at')->count();
        $this->lengkapSantri = DataSantri::count();
        $this->lengkapOrtu = DataOrtu::count();
        $this->lengkapBerkas = UploadBerkas::count();

        $this->masukPengumuman = Pengumuman::count();
        $totalTagihan = 4750000;

        $this->lunasPembayaran = User::where('role', 'user')
            ->whereHas('pembayaran')
            ->get()
            ->filter(function ($user) use ($totalTagihan) {
                $pembayaran = $user->pembayaran; // sudah collection

                $jumlahDibayar = $pembayaran
                    ->where('status', 'berhasil')
                    ->sum('jumlah');

                $semuaBerhasil = $pembayaran->count() > 0 && $pembayaran->every(function ($p) {
                    return $p->status === 'berhasil';
                });

                return $jumlahDibayar >= $totalTagihan && $semuaBerhasil;
            })
            ->count();

        $this->parsialPembayaran = User::where('role', 'user')
            ->whereHas('pembayaran')
            ->get()
            ->filter(function ($user) use ($totalTagihan) {
                $pembayaran = $user->pembayaran;

                $jumlahDibayar = $pembayaran
                    ->where('status', 'berhasil')
                    ->sum('jumlah');

                $adaBelumBerhasil = $pembayaran->contains(function ($p) {
                    return $p->status !== 'berhasil';
                });

                return $jumlahDibayar > 0 && ($jumlahDibayar < $totalTagihan || $adaBelumBerhasil);
            })
            ->count();

    }

    protected function getViewData(): array
    {
        return [
            'totalPendaftar' => $this->totalPendaftar,
            'verifikasiEmail' => $this->verifikasiEmail,
            'lengkapSantri' => $this->lengkapSantri,
            'lengkapOrtu' => $this->lengkapOrtu,
            'lengkapBerkas' => $this->lengkapBerkas,
            'lunasPembayaran' => $this->lunasPembayaran,
            'parsialPembayaran' => $this->parsialPembayaran,
            'masukPengumuman' => $this->masukPengumuman,
        ];
    }
}
