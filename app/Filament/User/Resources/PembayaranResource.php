<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PembayaranResource\Pages;
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

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Pembayaran'; // Label di sidebar

    protected static ?string $pluralModelLabel = 'Pembayaran Registrasi'; // Nama plural

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
            Pembayaran::query()
                ->where('user_id', Auth::id())
                ->where('status', 'menunggu')
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
                    ->label('Nama Pembayaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->formatStateUsing(function ($state) {
                        return 'Rp.' . number_format($state, 2, ',', '.');
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),


                TextColumn::make('created_at')
                    ->label('Tagihan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('bayar')
                    ->label('Bayar')
                    ->icon('heroicon-o-credit-card')
                    ->color('primary')
                    ->url(fn ($record) => route('midtrans.pay', ['pembayaran_id' => $record->id]))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->status === 'menunggu'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('bayar_bulk')
                    ->label('Bayar Terpilih')
                    ->icon('heroicon-o-credit-card')
                    ->color('primary')
                    ->action(function ($records) {
                        $ids = $records->pluck('id')->toArray();
                        $query = http_build_query(['ids' => $ids]);
                        return redirect()->away(route('midtrans.bulkPay') . '?' . $query);
                    })
                    ->requiresConfirmation()
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
