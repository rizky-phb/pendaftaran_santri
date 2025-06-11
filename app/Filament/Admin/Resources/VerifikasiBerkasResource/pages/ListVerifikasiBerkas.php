<?php

namespace App\Filament\Admin\Resources\VerifikasiBerkasResource\Pages;

use App\Filament\Admin\Resources\VerifikasiBerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVerifikasiBerkas extends ListRecords
{
    protected static string $resource = VerifikasiBerkasResource::class;

    protected static ?string $title = 'Data Santri';
    protected function getHeaderActions(): array
    {
        return [];
    }
}
