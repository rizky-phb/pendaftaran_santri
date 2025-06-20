<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GelombangResource\Pages;
use App\Models\User;
use App\Models\Gelombang;
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
use Filament\Forms\Components\DatePicker;

class GelombangResource extends Resource
{
    protected static ?string $model = Gelombang::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Tanggal Pendaftaran'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Gelombang'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 0; // ← Tambahkan ini untuk posisi
    public function mount(): void
{
    if (Auth::user()->role === 'user') {
        redirect('/user')->send();
        exit;
    }
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('gelombang')
                    ->numeric()
                    ->required(),

                DatePicker::make('tanggal_mulai')
                    ->required(),

                DatePicker::make('tanggal_selesai')
                    ->required(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gelombang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_mulai')
                    ->searchable()
                    ->dateTime('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_selesai')
                    ->searchable()
                    ->dateTime('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGelombang::route('/'),
            'create' => Pages\CreateGelombang::route('/create'),
            'edit' => Pages\EditGelombang::route('/{record}/edit'),
        ];
    }
}
