<?php

namespace App\Filament\Superadmin\Resources\TagihanResource\Pages;

use App\Filament\Superadmin\Resources\TagihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTagihan extends EditRecord
{
    protected static string $resource = TagihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
