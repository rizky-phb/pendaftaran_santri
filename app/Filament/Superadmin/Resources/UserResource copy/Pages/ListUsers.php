<?php

namespace App\Filament\Superadmin\Resources\UserResource\Pages;

use App\Filament\Superadmin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
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
