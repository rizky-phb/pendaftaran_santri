<?php
namespace App\Filament\User\Resources\DataSantriResource\pages;

use Illuminate\Support\Facades\Auth;

use App\Filament\User\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataSantri extends CreateRecord
{
    protected static string $resource = DataSantriResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Mengisi otomatis dari user yang login
        return $data;
    }
}
