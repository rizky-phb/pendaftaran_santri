<?php

namespace App\Filament\User\Resources\TransaksiResource\Pages;

use App\Filament\User\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

use Filament\Actions\Action;
use Illuminate\Support\Facades\Redirect;
class ListTransaksi extends ListRecords
{
    protected static string $resource = TransaksiResource::class;
    public function mount(): void
    {
        if (Auth::user()->role === 'admin') {
            redirect('/admin')->send();
            exit;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export-csv-all')
                ->label('Export Semua (CSV)')
                ->url('http://localhost:8000/export-transaksi/'.Auth::id())
                ->openUrlInNewTab()
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary'),

            Action::make('export-pdf-all')
                ->label('Export Semua (PDF)')
                ->url('http://localhost:8000/export-transaksi-pdf/'.Auth::id())
                ->openUrlInNewTab()
                ->icon('heroicon-o-document')
                ->color('info'),
        ];
    }
}
