<?php

namespace App\Filament\User\Resources\DataOrtuResource\Pages;

use App\Filament\User\Resources\DataOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataOrtu extends EditRecord
{
    protected static string $resource = DataOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
