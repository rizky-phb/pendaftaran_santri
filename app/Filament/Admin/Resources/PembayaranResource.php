<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembayaranResource\Pages;
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
class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Pembayaran'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'List Pembayaran yg Berhasil'; // Nama plural

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
                    ->label('Jenis Pembayaran'),

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
        ->query(
                Pembayaran::with(['user.santri', 'transactions' => function ($q) {
                    $q->orderByDesc('created_at'); // atau pakai latest() jika kamu mau transaksi terbaru
                }])->whereHas('transactions', function ($q) {
                    $q->where('status', 'settlement');
                })

        )

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
                TextColumn::make('user.santri.nama_lengkap')
                    ->label('Nama Santri')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_pembayaran')
                    ->label('Nama Pembayaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('transactions.0.status')
                    ->label('Status'),

                TextColumn::make('transactions.0.payment_type')
                    ->label('Payment Type'),

                TextColumn::make('transactions.0.transaction_time')
                    ->label('Waktu Transaksi'),

                TextColumn::make('transactions.0.bank')
                    ->label('Bank'),

                TextColumn::make('transactions.0.va_number')
                    ->label('VA Number'),

            ])
            ->actions([
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
            'index' => Pages\ListPembayaran::route('/'),
        ];
    }
}
