<?php

namespace App\Filament\User\Resources\DataOrtuResource\Pages;

use App\Filament\User\Resources\DataOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\DataOrtu;

class CreateDataOrtu extends CreateRecord
{
    protected static string $resource = DataOrtuResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Mengisi otomatis dari user yang login
        return $data;
    }
}
