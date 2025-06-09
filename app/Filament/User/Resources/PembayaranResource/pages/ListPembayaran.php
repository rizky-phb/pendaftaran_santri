<?php

namespace App\Filament\User\Resources\PembayaranResource\Pages;

use App\Filament\User\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
