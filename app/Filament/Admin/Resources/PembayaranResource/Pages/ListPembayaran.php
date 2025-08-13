<?php

namespace App\Filament\Admin\Resources\PembayaranResource\Pages;

use App\Filament\Admin\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\Action;
use Filament\Tables\Filters\SelectFilter; // Tambahkan ini

class ListPembayaran extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

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
                ->url('http://localhost:8000/export-transaksi/')
                ->openUrlInNewTab()
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary'),

            Action::make('export-pdf-all')
                ->label('Export Semua (PDF)')
                ->url('http://localhost:8000/export-transaksi-pdf/')
                ->openUrlInNewTab()
                ->icon('heroicon-o-document')
                ->color('info'),
        ];
    }

    /**
     * Tambahkan filter status di tabel pembayaran
     */
    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')
                ->label('Status Pembayaran')
                ->options([
                    'pending' => 'Pending',
                    'lunas' => 'Lunas',
                    'gagal' => 'Gagal',
                ])
                ->attribute('status') // kolom di database
                ->default(null),
        ];
    }
}
