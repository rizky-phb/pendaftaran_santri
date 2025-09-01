<?php

namespace App\Filament\Superadmin\Resources\PembayaranResource\Pages;

use App\Filament\Superadmin\Resources\PembayaranResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    public static function canCreateAnother(): bool
    {
        return false;
    }
    // ✅ Tambahkan method ini agar tidak redirect ke Edit
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
