<?php

namespace App\Filament\Admin\Resources\GelombangResource\Pages;

use App\Filament\Admin\Resources\GelombangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGelombang extends EditRecord
{
    protected static string $resource = GelombangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
