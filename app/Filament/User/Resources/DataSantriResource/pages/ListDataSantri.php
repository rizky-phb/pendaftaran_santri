<?php

namespace App\Filament\User\Resources\DataSantriResource\Pages;

use App\Filament\User\Resources\DataSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSantri;

use Illuminate\Support\Facades\Redirect;
class ListDataSantri extends ListRecords
{
    protected static string $resource = DataSantriResource::class;
    public function mount(): void
    {
        if (Auth::user()->role === 'admin') {
            redirect('/admin')->send();
            exit;
        }
    }
    protected function getHeaderActions(): array
    {
        $hasdata = DataSantri::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [];
        }
        else{
            return [
                Actions\CreateAction::make(),
            ];
        };
    }
}
