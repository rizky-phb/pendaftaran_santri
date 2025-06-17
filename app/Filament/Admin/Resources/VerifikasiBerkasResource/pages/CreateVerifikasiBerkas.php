<?php

namespace App\Filament\Admin\Resources\VerifikasiBerkasResource\Pages;

use App\Filament\Admin\Resources\VerifikasiBerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVerifikasiBerkas extends CreateRecord
{
    protected static string $resource = VerifikasiBerkasResource::class;
    public static function canCreateAnother(): bool
    {
        return false;
    }
}


