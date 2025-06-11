<?php

namespace App\Filament\User\Resources\PembayaranResource\Pages;

use App\Filament\User\Resources\PembayaranResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class BayarPembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Mengisi otomatis dari user yang login
        return $data;
    }
}
