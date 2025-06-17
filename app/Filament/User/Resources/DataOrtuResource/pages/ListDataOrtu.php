<?php

namespace App\Filament\User\Resources\DataOrtuResource\Pages;

use App\Filament\User\Resources\DataOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use App\Models\DataOrtu;

use Illuminate\Support\Facades\Redirect;
class ListDataOrtu extends ListRecords
{
    protected static string $resource = DataOrtuResource::class;
    public function mount(): void
{
    if (Auth::user()->role === 'admin') {
        redirect('/admin')->send();
        exit;
    }
}

    protected function getHeaderActions(): array
    {
        $hasdata = DataOrtu::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
