<?php

namespace App\Filament\Admin\Resources\VerifikasiBerkasResource\Pages;

use App\Filament\Admin\Resources\VerifikasiBerkasResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListVerifikasiBerkas extends ListRecords
{
    protected static string $resource = VerifikasiBerkasResource::class;

    protected static ?string $title = 'Data Santri';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export-csv-all')
                ->label('Export Semua (CSV)')
                ->url('http://localhost:8000/export-santri')
                ->openUrlInNewTab()
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary'),

            Action::make('export-pdf-all')
                ->label('Export Semua (PDF)')
                ->url('http://localhost:8000/export-santri-pdf')
                ->openUrlInNewTab()
                ->icon('heroicon-o-document')
                ->color('info'),
        ];
    }
}
