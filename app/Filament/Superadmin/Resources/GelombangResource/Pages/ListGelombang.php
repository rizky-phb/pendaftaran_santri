<?php

namespace App\Filament\Superadmin\Resources\GelombangResource\Pages;

use App\Filament\Superadmin\Resources\GelombangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class ListGelombang extends ListRecords
{
    protected static string $resource = GelombangResource::class;
    public function mount(): void
    {
        if (Auth::user()->role === 'user') {
            redirect('/user')->send();
            exit;
        }
        if (Auth::user()->role === 'user') {
            redirect('/user')->send();
            exit;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
