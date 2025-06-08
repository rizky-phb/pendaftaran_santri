<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
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

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pendaftaran'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Pendaftar calon santri'; // Nama plural

    protected static ?string $navigationGroup = 'Role'; // Group menu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('no_hp')
                    ->label('No. HP')
                    ->required()
                    ->maxLength(15)
                    ->rule('regex:/^(?:\+62|62|0)8[1-9][0-9]{6,10}$/')
                    ->helperText('Masukkan nomor HP Indonesia yang valid, contoh: 081234567890'),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(4)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('no_hp')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                // admin memverifikasi data yg dikirim pendaftar lalu mengklik tombol centang yang artinya user diperbolehkan untuk mendaftar dan user diberi akun role user, username dan password (password bisa automatis pake default 123 atau sesuatu yg unik dari nama email, nama lengkap dan alamatnya ) biar bisa login dan mengupload berkas untuk benar benar mendaftar
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
