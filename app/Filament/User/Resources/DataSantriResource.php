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

use Illuminate\Support\Facades\Redirect;
class DataSantriResource extends Resource
{
    protected static ?string $model = DataSantri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Data Santri'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Input Data Santri'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 0; // ← Tambahkan ini untuk posisi

    public function mount(): void
{
    if (Auth::user()->role === 'admin') {
        redirect('/admin')->send();
        exit;
    }
}

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama_lengkap')
                ->maxLength(35)
                ->minLength(3)
                ->extraAttributes([
                    'pattern' => '[a-zA-Z\s]{3,35}',
                    'oninput' => "if(this.value.length > 35) this.value = this.value.slice(0,35);",
                    'title' => "Nama harus 3-35 karakter (hanya huruf dan spasi)",
                    'onkeydown' => "return !(/[0-9]/.test(event.key));"
                ])
                ->required(),
            TextInput::make('nisn')
            ->label('NISN')
            ->required()
            ->numeric() // Validasi angka
            ->maxLength(10)
            ->minLength(10)
            ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
            ->extraAttributes([
                'pattern' => '[0-9]*',
                'maxlength' => 10,
                'title' => "NISN harus 10 karakter (hanya angka)",
                'onkeydown' => "return (!this.value || this.value.length < 10) || event.key === 'Backspace' || event.key === 'Delete';"
            ]), // Batasi input hanya angka (untuk browser)
            DatePicker::make('tanggal_lahir')
                ->required()
                ->maxDate(now()->subYears(10)), // Tidak bisa input kurang dari 10 tahun dari sekarang
            TextInput::make('tempat_lahir')->required(),
            TextInput::make('agama')->required(),
            Select::make('jenis_kelamin')
                ->options([
                    'laki-laki' => 'Laki-laki',
                    'perempuan' => 'Perempuan',
                ])
                ->required(),
            Textarea::make('alamat')
            ->maxLength(100)
            ->rows(4)
            ->required(),
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
                ->hidden() // Sembunyikan kolom user_id dari tabel
                ->label('User ID')
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
                'index' => Pages\ListDataSantri::route('/'),
                'edit' => Pages\EditDataSantri::route('/{record}/edit'),
            ];
        }
        return [
            'index' => Pages\ListDataSantri::route('/'),
            'create' => Pages\CreateDataSantri::route('/create'),
            'edit' => Pages\EditDataSantri::route('/{record}/edit'),
        ];
    }
}
