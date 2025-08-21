<?php

namespace App\Filament\User\Resources\TransaksiResource\Pages;

use App\Filament\User\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksi extends EditRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Mengisi otomatis dari user yang login
        return $data;
    }
      // ✅ Tambahkan method ini agar tidak redirect ke Edit
      protected function getRedirectUrl(): string
      {
          return static::getResource()::getUrl('index');
      }
}
