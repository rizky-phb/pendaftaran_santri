<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class UserDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'livewire.user.pages.dashboard';

    public function mount()
    {
        $this->user = auth()->user();
        $this->user->load(['santri', 'ortu', 'berkas', 'pembayaran']);
        $this->pengumuman = \App\Models\Pengumuman::where('user_id', $this->user->id)->first();

        $tanggalSekarang = now()->toDateString();
        $this->gelombang = \App\Models\Gelombang::where('tanggal_mulai', '<=', $tanggalSekarang)
            ->where('tanggal_selesai', '>=', $tanggalSekarang)
            ->first();
    }

    protected function getViewData(): array
    {
        return [
            'user' => $this->user,
            'pengumuman' => $this->pengumuman,
            'gelombang' => $this->gelombang,
        ];
    }
}
