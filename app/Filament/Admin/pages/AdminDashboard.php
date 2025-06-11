<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Models\DataSantri;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AdminDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'livewire.admin.pages.dashboard';
    protected static ?string $model = User::class;

    // Gabungkan data user (role user) dengan data santri, ortu, dan upload berkas
    public static function getEloquentQuery(): Builder
    {
        return (static::$model)::query()
            ->where('role', 'user')
            ->whereHas('berkas', function ($query) {
                $query->where('status', 'Approved');
            }) // Hanya ambil user yang memiliki berkas dengan status Approved
            ->with(['santri', 'ortu', 'berkas']); // pastikan relasi ini ada di model User
    }

    public function getPendingBerkasCount(): int
    {
        return static::getEloquentQuery()->count();
    }
}
