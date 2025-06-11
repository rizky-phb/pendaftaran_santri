<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VerifikasiBerkasResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\View;
use Filament\Forms\Components\downlaodfile;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class VerifikasiBerkasResource extends Resource
{
    protected static ?string $model = User::class;

    // Gabungkan data user (role user) dengan data santri, ortu, dan upload berkas
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'user')
            ->with(['santri', 'ortu', 'berkas']); // pastikan relasi ini ada di model User
    }
    // Hapus method getRecord, karena Filament otomatis mengisi form edit jika relasi sudah di-eager load di getEloquentQuery()
    // Tidak perlu menambahkan method getRecord di sini.
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Rekap Data Santri'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Pendaftaran'; // Nama plural

    protected static ?string $navigationGroup = 'Role'; // Group menu

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            // Data Santri (gunakan dot notation untuk relasi)
            TextInput::make('santri.nama_lengkap')
                ->label('Nama Lengkap Santri')
                ->maxLength(255),

            TextInput::make('santri.nisn')
                ->label('NISN')
                ->maxLength(20),

            TextInput::make('santri.tanggal_lahir')
                ->label('Tanggal Lahir')
                ->type('date'),

            TextInput::make('santri.tempat_lahir')
                ->label('Tempat Lahir')
                ->maxLength(255),

            Select::make('santri.agama')
                ->label('Agama')
                ->options([
                    'Islam' => 'Islam',
                    'Kristen' => 'Kristen',
                    'Katolik' => 'Katolik',
                    'Hindu' => 'Hindu',
                    'Buddha' => 'Buddha',
                    'Konghucu' => 'Konghucu',
                ]),

            Select::make('santri.jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ]),

            Forms\Components\Textarea::make('santri.alamat')
                ->label('Alamat')
                ->maxLength(255),

            // Data Orang Tua (gunakan dot notation untuk relasi)
            TextInput::make('ortu.nama_ayah')
                ->label('Nama Ayah')
                ->maxLength(255),

            TextInput::make('ortu.nik_ayah')
                ->label('NIK Ayah')
                ->maxLength(20),

            TextInput::make('ortu.pendidikan_terakhir_ayah')
                ->label('Pendidikan Terakhir Ayah')
                ->maxLength(100),

            TextInput::make('ortu.pekerjaan_ayah')
                ->label('Pekerjaan Ayah')
                ->maxLength(100),

            TextInput::make('ortu.no_hp_ayah')
                ->label('No HP Ayah')
                ->tel()
                ->maxLength(20)
                ->placeholder('08xxxxxxxxxx'),

            TextInput::make('ortu.nama_ibu')
                ->label('Nama Ibu')
                ->maxLength(255),

            TextInput::make('ortu.nik_ibu')
                ->label('NIK Ibu')
                ->maxLength(20),

            TextInput::make('ortu.pendidikan_terakhir_ibu')
                ->label('Pendidikan Terakhir Ibu')
                ->maxLength(100),

            TextInput::make('ortu.pekerjaan_ibu')
                ->label('Pekerjaan Ibu')
                ->maxLength(100),

            TextInput::make('ortu.no_hp_ibu')
                ->label('No HP Ibu')
                ->tel()
                ->maxLength(20)
                ->placeholder('08xxxxxxxxxx'),
            FileUpload::make('berkas.berkas_fc_sttb')
                ->label('FC STTB')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),

            FileUpload::make('berkas.berkas_skhun')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            FileUpload::make('berkas.berkas_pas_foto')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            FileUpload::make('berkas.berkas_akte_kelahiran')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            FileUpload::make('berkas.berkas_blangko_pendaftaran')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            FileUpload::make('berkas.berkas_nisn')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            FileUpload::make('berkas.berkas_kartu_keluarga')
                ->disk('public')
                ->directory('uploads')
                ->downloadable(),
            Select::make('berkas.status')
                ->label('Status Berkas')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ]),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('email')
                    ->label('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('santri.nama_lengkap')
                ->label('nama lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('santri.nisn')
                ->label('NISN')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('santri.agama')
                ->label('agama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('santri.jenis_kelamin')
                ->label('jenis kelamin')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('santri.alamat')
                ->label('alamat')
                    ->searchable()
                    ->sortable(),

                // Kolom dari relasi ortu
                TextColumn::make('ortu.nama_ayah')
                ->label('nama ayah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('berkas.berkas_fc_sttb')
                    ->label('FC STTB')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $url = asset('storage/' . $state);
                            $ext = strtolower(pathinfo($state, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                                return '<div style="text-align:center;">
                                    <img src="' . $url . '" alt="FC STTB" style="max-width:60px;max-height:60px;cursor:pointer;border-radius:4px;border:1px solid #eee;" onclick="showImageModal(\'' . $url . '\')" />
                                    <br>
                                    <a href="' . $url . '" download style="color: #3b82f6; text-decoration: underline; font-size:12px;">Detail</a>
                                </div>';
                            }
                            return '<a href="' . $url . '" download style="color: #3b82f6; text-decoration: underline;">Detail</a>';
                        }
                        return '-';
                    })
                    ->html(),
                TextColumn::make('berkas.status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('berkas.status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->label('Filter by Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Detail'),
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
            'index' => Pages\ListVerifikasiBerkas::route('/'),
            'edit' => Pages\EditVerifikasiBerkas::route('/{record}/edit'),
        ];
    }
}
