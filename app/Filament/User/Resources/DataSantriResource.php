<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\DataSantriResource\Pages;
use App\Models\DataSantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use App\Mail\AkunDibuatMail;
use Illuminate\Support\Facades\Mail;use Filament\Forms\Components\DatePicker;


class DataSantriResource extends Resource
{
    protected static ?string $model = DataSantri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Santri'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Input Data Santri'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 0; // ← Tambahkan ini untuk posisi

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nisn')
                    ->label('NISN')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(100)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser)
                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->required(),
                TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(100),
                TextInput::make('agama')
                    ->required()
                    ->maxLength(100),
                Select::make('jenis_kelamin')
                    ->options([
                        'laki-laki' => 'Laki-laki',
                        'perempuan' => 'Perempuan',
                    ])
                    ->required()
                    ->default('laki-laki'),
                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(4)
                    ->required(),

            ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CreateDataSantri::route('/'),
        ];
    }
}
