<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TransaksiResource\Pages;
use App\Models\Pembayaran;
use App\Models\Transaction;
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
use App\Mail\AkunDibuatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;

use Illuminate\Support\Facades\Redirect;
class TransaksiResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Detail Transaksi'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'List Transaksi'; // Nama plural

    protected static ?string $navigationGroup = 'Alur Pendaftaran'; // Group menu
    protected static ?int $navigationSort = 3; // ← Tambahkan ini untuk posisi
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
                    ->label('Jenis Transaksi'),

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

                Forms\Components\FileUpload::make('bukti_transfer')
                    ->label('Bukti Transfer')
                    ->required()
                    ->directory('bukti_transfer'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(
            Pembayaran::where('user_id', Auth::id())
                ->whereHas('transactions', function ($q) {
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

                TextColumn::make('jenis_pembayaran')
                    ->label('Nama Transaksi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                TextColumn::make('tanggal_bayar')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('bukti_transfer')
                    ->label('Bukti Transfer')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Tanggal Tagihan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                Action::make('lihatDetail')
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Transaksi')
                    ->modalSubheading('Menampilkan semua transaksi terkait pembayaran ini.')
                    ->modalContent(fn ($record) => view('components.detail-transaksi', [
                        'transactions' => $record->transactions, // Mengambil semua transaksi relasi dari pembayaran
                    ]))
                    ->visible(fn ($record) => $record->transactions()->exists()),
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
            'index' => Pages\ListTransaksi::route('/'),
        ];
    }
}
