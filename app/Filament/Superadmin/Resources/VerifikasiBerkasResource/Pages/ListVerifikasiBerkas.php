<?php

namespace App\Filament\Superadmin\Resources\VerifikasiBerkasResource\Pages;

use App\Filament\Superadmin\Resources\VerifikasiBerkasResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
class ListVerifikasiBerkas extends ListRecords
{
    protected static string $resource = VerifikasiBerkasResource::class;

    protected static ?string $title = 'Rekap Data Santri';
    public function mount(): void
{
    if (Auth::user()->role === 'user') {
        redirect('/user')->send();
        exit;
    }
}
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
