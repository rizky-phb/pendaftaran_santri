<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\DataOrtuResource\Pages;
use App\Models\User;
use App\Models\DataOrtu;
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
use Illuminate\Support\Facades\Auth;

class DataOrtuResource extends Resource
{
    protected static ?string $model = DataOrtu::class; // <-- Ganti model sesuai yang valid

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Ortu'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Input Data Ortu'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 1; // ← Tambahkan ini untuk posisi


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_ayah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nama_ibu')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nik_ayah')
                    ->label('NIK Ayah')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(17)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);
                TextInput::make('nik_ibu')
                    ->label('NIK Ibu')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(17)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);;
                TextInput::make('pendidikan_terakhir_ayah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pendidikan_terakhir_ibu')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pekerjaan_ayah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pekerjaan_ibu')
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_hp_ayah')
                    ->label('No HP Ayah')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(100)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);
                TextInput::make('no_hp_ibu')
                    ->label('No HP ibu')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(100)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                DataOrtu::query()->where('user_id', Auth::id())
            )
            ->columns([
                TextColumn::make('nama_ayah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nik_ayah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pendidikan_terakhir_ayah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pekerjaan_ayah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_hp_ayah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_ibu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nik_ibu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pendidikan_terakhir_ibu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pekerjaan_ibu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_hp_ibu')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        $hasdata = DataOrtu::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [
                'index' => Pages\ListDataOrtu::route('/'),
                'edit' => Pages\EditDataOrtu::route('/{record}/edit'),
            ];
        }
        return [
            'index' => Pages\ListDataOrtu::route('/'),
            'create' => Pages\CreateDataOrtu::route('/create'),
            'edit' => Pages\EditDataOrtu::route('/{record}/edit'),
        ];
    }
}
