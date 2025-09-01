<?php

namespace App\Filament\Superadmin\Resources\RekapPenerimaanResource\Pages;

use App\Filament\Superadmin\Resources\RekapPenerimaanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
class ListRekapPenerimaan extends ListRecords
{
    protected static string $resource = RekapPenerimaanResource::class;

    protected static ?string $title = 'Rekap Penerimaan Santri';
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
