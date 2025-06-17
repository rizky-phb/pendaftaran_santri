<?php

namespace App\Filament\Admin\Resources\PendaftaranResource\Pages;

use App\Filament\Admin\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendaftaran extends CreateRecord
{
    protected static string $resource = PendaftaranResource::class;

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
