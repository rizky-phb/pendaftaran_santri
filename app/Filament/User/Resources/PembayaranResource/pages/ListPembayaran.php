<?php

namespace App\Filament\User\Resources\PembayaranResource\Pages;

use App\Filament\User\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class ListPembayaran extends ListRecords
{
    protected static string $resource = PembayaranResource::class;
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
        ];
    }
}
