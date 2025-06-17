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
            FileUpload::make('berkas_fc_sttb')
            ->label('upload fc sttb')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_skhun')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_pas_foto')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_akte_kelahiran')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_blangko_pendaftaran')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_nisn')
            ->disk('public')
            ->directory('uploads'),
            FileUpload::make('berkas_kartu_keluarga')
            ->disk('public')
            ->directory('uploads'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(
            UploadBerkas::query()->where('user_id', Auth::id())
        )
            ->columns([
                TextColumn::make('berkas_fc_sttb')
                    ->label('FC STTB')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="FC STTB" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_skhun')
                    ->label('SKHUN')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="SKHUN" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_pas_foto')
                    ->label('Pas Foto')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="Pas Foto" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_akte_kelahiran')
                    ->label('Akte Kelahiran')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="Akte Kelahiran" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_blangko_pendaftaran')
                    ->label('Blangko Pendaftaran')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="Blangko Pendaftaran" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_nisn')
                    ->label('NISN')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="NISN" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas_kartu_keluarga')
                    ->label('Kartu Keluarga')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="Kartu Keluarga" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('status')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
