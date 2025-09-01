<?php

namespace App\Filament\Superadmin\Resources\PengumumanResource\Pages;

use App\Filament\Superadmin\Resources\PengumumanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class ListPengumuman extends ListRecords
{
    protected static string $resource = PengumumanResource::class;
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
            Actions\CreateAction::make(),
        ];
    }
}
