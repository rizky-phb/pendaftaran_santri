<?php

namespace App\Filament\Superadmin\Resources\UserResource\Pages;

use App\Filament\Superadmin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
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
