<?php

namespace App\Filament\User\Resources\DataOrtuResource\Pages;

use App\Filament\User\Resources\DataOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataOrtu extends ListRecords
{
    protected static string $resource = DataOrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
