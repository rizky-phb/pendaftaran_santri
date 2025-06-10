<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UploadBerkasResource\Pages;
use App\Models\UploadBerkas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use App\Mail\AkunDibuatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UploadBerkasResource extends Resource
{
    protected static ?string $model = UploadBerkas::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Upload Berkas'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Upload Berkas Pendaftaran'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 2; // ← Tambahkan ini untuk posisi


    public static function form(Form $form): Form
    {
        // Daftar nama berkas yang harus diupload
        return $form->schema([
            FileUpload::make('berkas_fc_sttb'),
            FileUpload::make('berkas_skhun'),
            FileUpload::make('berkas_pas_foto'),
            FileUpload::make('berkas_akte_kelahiran'),
            FileUpload::make('berkas_blangko_pendaftaran'),
            FileUpload::make('berkas_nisn'),
            FileUpload::make('berkas_kartu_keluarga')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('berkas_fc_sttb')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_skhun')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_pas_foto')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_akte_kelahiran')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_blangko_pendaftaran')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_nisn')
                ->searchable()
                ->sortable(),
                TextColumn::make('berkas_kartu_keluarga')
                ->searchable()
                ->sortable(),
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
        $hasdata = UploadBerkas::query()->where('user_id', Auth::id())->exists();
        if ($hasdata){
            return [
                'index' => Pages\ListUploadBerkas::route('/'),
                'edit' => Pages\EditUploadBerkas::route('/{record}/edit'),
            ];
        }
        return [
            'index' => Pages\ListUploadBerkas::route('/'),
            'create' => Pages\CreateUploadBerkas::route('/create'),
            'edit' => Pages\EditUploadBerkas::route('/{record}/edit'),
        ];
    }
}
