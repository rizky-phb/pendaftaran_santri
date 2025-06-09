<?php

namespace App\Filament\User\Resources\DataSantriResource\Pages;

use App\Filament\User\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataSantri extends EditRecord
{
    protected static string $resource = DataSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
