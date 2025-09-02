<?php

namespace App\Filament\Superadmin\Resources;

use App\Filament\Superadmin\Resources\TagihanResource\Pages;
use App\Models\Pembayaran;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use App\Mail\AkunDibuatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
class TagihanResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Tagihan'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'List Tagihan'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 4; // ← Tambahkan ini untuk posisi
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
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Nama Pengguna'),

                Select::make('jenis_pembayaran')
                    ->options([
                        'registrasi' => 'Registrasi',
                        'spp' => 'SPP',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Jenis Tagihan'),

                TextInput::make('jumlah')
                    ->numeric()
                    ->required()
                    ->label('Jumlah'),

                TextInput::make('tanggal_bayar')
                    ->type('date')
                    ->required()
                    ->label('Tanggal Bayar'),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'berhasil' => 'Berhasil',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required()
                    ->label('Status'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->state(function ($record, $livewire) {
                        $perPage = (int) $livewire->getTableRecordsPerPage();
                        $page = (int) $livewire->getTablePage();
                        $index = $livewire->getTableRecords()->search(function ($item) use ($record) {
                            return $item->getKey() === $record->getKey();
                        });

                        return ($page - 1) * $perPage + $index + 1;
                    }),
                TextColumn::make('user.name')
                    ->label('username')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_pembayaran')
                    ->label('Nama Tagihan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state === 'menunggu' ? 'belum bayar' : $state)
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Tagihan')
                    ->options([
                        'pending' => 'Pending',
                        'menunggu' => 'Belum bayar',
                        'berhasil' => 'Berhasil',
                        'ditolak' => 'Ditolak',
                    ]),

            ])
            ->actions([])
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
            'index' => Pages\ListTagihan::route('/'),
        ];
    }
}
