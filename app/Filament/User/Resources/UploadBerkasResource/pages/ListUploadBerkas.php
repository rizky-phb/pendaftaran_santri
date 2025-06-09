<?php

namespace App\Filament\User\Resources\UploadBerkasResource\Pages;

use App\Filament\User\Resources\UploadBerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUploadBerkass extends ListRecords
{
    protected static string $resource = UploadBerkasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
