<?php

namespace App\Filament\Admin\Resources\GelombangResource\Pages;

use App\Filament\Admin\Resources\GelombangResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreateGelombang extends CreateRecord
{
    protected static string $resource = GelombangResource::class;

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
