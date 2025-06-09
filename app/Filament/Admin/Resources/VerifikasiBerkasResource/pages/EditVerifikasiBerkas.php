<?php

namespace App\Filament\Admin\Resources\VerifikasiBerkasResource\Pages;

use App\Filament\Admin\Resources\VerifikasiBerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerifikasiBerkas extends EditRecord
{
    protected static string $resource = VerifikasiBerkasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
