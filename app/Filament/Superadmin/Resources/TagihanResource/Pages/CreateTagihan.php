<?php

namespace App\Filament\Superadmin\Resources\TagihanResource\Pages;

use App\Filament\Superadmin\Resources\TagihanResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreateTagihan extends CreateRecord
{
    protected static string $resource = TagihanResource::class;

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
