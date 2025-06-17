<?php

namespace App\Filament\User\Resources\TransaksiResource\Pages;

use App\Filament\User\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

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
        ];
    }
}
