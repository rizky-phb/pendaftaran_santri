<?php

namespace App\Filament\User\Resources\DataOrtuResource\Pages;

use App\Filament\User\Resources\DataOrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use App\Models\DataOrtu;

class ListDataOrtu extends ListRecords
{
    protected static string $resource = DataOrtuResource::class;

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
