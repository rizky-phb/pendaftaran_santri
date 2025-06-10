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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;

class DataSantriResource extends Resource
{
    protected static ?string $model = DataSantri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Data Santri'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Input Data Santri'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 0; // ← Tambahkan ini untuk posisi

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama_lengkap')->required(),
            TextInput::make('nisn')
            ->label('NISN')
            ->required()
            ->numeric() // Validasi angka
            ->maxLength(100)
            ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
            ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser)
            DatePicker::make('tanggal_lahir')->required(),
            TextInput::make('tempat_lahir')->required(),
            TextInput::make('agama')->required(),
            Select::make('jenis_kelamin')
                ->options([
                    'laki-laki' => 'Laki-laki',
                    'perempuan' => 'Perempuan',
                ])
                ->required(),
            Textarea::make('alamat')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                DataSantri::query()->where('user_id', Auth::id())
            )
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nisn')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_lahir')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tempat_lahir')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('agama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_kelamin')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user_id')
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
        $hasdata = DataSantri::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [
                'index' => Pages\ListDataSantris::route('/'),
                'edit' => Pages\EditDataSantri::route('/{record}/edit'),
            ];
        }
        return [
            'index' => Pages\ListDataSantris::route('/'),
            'create' => Pages\CreateDataSantri::route('/create'),
            'edit' => Pages\EditDataSantri::route('/{record}/edit'),
        ];
    }
}
