<?php

namespace App\Filament\Admin\Resources\RekapPenerimaanResource\Pages;

use App\Filament\Admin\Resources\RekapPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRekapPenerimaan extends CreateRecord
{
    protected static string $resource = RekapPenerimaanResource::class;
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


