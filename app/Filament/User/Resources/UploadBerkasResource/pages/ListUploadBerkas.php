<?php

namespace App\Filament\User\Resources\UploadBerkasResource\Pages;

use App\Filament\User\Resources\UploadBerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadBerkas;

use Illuminate\Support\Facades\Redirect;
class ListUploadBerkas extends ListRecords
{
    protected static string $resource = UploadBerkasResource::class;
    public function mount(): void
    {
        if (Auth::user()->role === 'admin') {
            redirect('/admin')->send();
            exit;
        }
    }

    protected function getHeaderActions(): array
    {
        $hasdata = UploadBerkas::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [];
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
