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

use Illuminate\Support\Facades\Redirect;
class DataOrtuResource extends Resource
{
    protected static ?string $model = DataOrtu::class; // <-- Ganti model sesuai yang valid

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Ortu'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Input Data Ortu'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 1; // ← Tambahkan ini untuk posisi


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
                TextInput::make('nama_ayah')
                ->maxLength(35)
                ->minLength(3)
                ->extraAttributes([
                    'pattern' => '[a-zA-Z\s]{3,35}',
                    'oninput' => "if(this.value.length > 35) this.value = this.value.slice(0,35);",
                    'title' => "Nama harus 3-35 karakter (hanya huruf dan spasi)",
                    'onkeydown' => "return !(/[0-9]/.test(event.key));"
                ])
                ->required(),
                TextInput::make('nama_ibu')
                ->maxLength(35)
                ->minLength(3)
                ->extraAttributes([
                    'pattern' => '[a-zA-Z\s]{3,35}',
                    'oninput' => "if(this.value.length > 35) this.value = this.value.slice(0,35);",
                    'title' => "Nama harus 3-35 karakter (hanya huruf dan spasi)",
                    'onkeydown' => "return !(/[0-9]/.test(event.key));"
                ])
                ->required(),
                TextInput::make('nik_ayah')
                    ->label('NIK Ayah')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(16)
                    ->minLength(16)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);
                TextInput::make('nik_ibu')
                    ->label('NIK Ibu')
                    ->required()
                    ->numeric() // Validasi angka
                    ->maxLength(16)
                    ->minLength(16)
                    ->inputMode('numeric') // Ubah keyboard jadi angka di mobile
                    ->extraAttributes(['pattern' => '[0-9]*']), // Batasi input hanya angka (untuk browser);;
                TextInput::make('pendidikan_terakhir_ayah')
                ->maxLength(3)
                ->minLength(2)
                ->extraAttributes([
                    'pattern' => '[a-zA-Z\s]{0,3}',
                    'oninput' => "if(this.value.length > 3) this.value = this.value.slice(0,3);",
                    'title' => "3 digit pendidikan terakhir (hanya huruf dan spasi)",
                    'onkeydown' => "return !(/[0-9]/.test(event.key));"
                ])
                ->required(),
                TextInput::make('pendidikan_terakhir_ibu')
                    ->maxLength(3)
                    ->minLength(2)
                    ->extraAttributes([
                        'pattern' => '[a-zA-Z\s]{3,35}',
                        'oninput' => "if(this.value.length > 35) this.value = this.value.slice(0,35);",
                        'title' => "3 digit pendidikan terakhir (hanya huruf dan spasi)",
                        'onkeydown' => "return !(/[0-9]/.test(event.key));"
                    ])
                    ->required(),
                TextInput::make('pekerjaan_ayah')
                    ->required()
                    ->minLength(5)
                    ->maxLength(255),
                TextInput::make('pekerjaan_ibu')
                    ->required()
                    ->minLength(5)
                    ->maxLength(255),
                TextInput::make('no_hp_ayah')
                    ->label('No HP Ayah')
                    ->required()
                    ->tel() // Gunakan input type tel
                    ->placeholder('08xxxxxxxxxx')
                    ->minLength(10)
                    ->maxLength(14)
                    ->extraAttributes([
                        'pattern' => '^08[0-9]{8,12}$',
                        'title' => 'Nomor HP harus diawali 08 dan hanya angka (10-14 digit)',
                        'oninput' => "if(this.value.length > 14) this.value = this.value.slice(0,14);",
                        'onkeydown' => "return !(/[a-zA-Z\\s]/.test(event.key));"
                    ]),
                TextInput::make('no_hp_ibu')
                    ->label('No HP ibu')
                    ->required()
                    ->tel() // Gunakan input type tel
                    ->placeholder('08xxxxxxxxxx')
                    ->minLength(10)
                    ->maxLength(14)
                    ->extraAttributes([
                        'pattern' => '^08[0-9]{8,12}$',
                        'title' => 'Nomor HP harus diawali 08 dan hanya angka (10-14 digit)',
                        'oninput' => "if(this.value.length > 14) this.value = this.value.slice(0,14);",
                        'onkeydown' => "return !(/[a-zA-Z\\s]/.test(event.key));"
                    ]),

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
