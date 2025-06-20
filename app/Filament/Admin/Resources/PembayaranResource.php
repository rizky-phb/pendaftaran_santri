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
            Pembayaran::with('user.santri')->whereHas('transactions', function ($q) {
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

                    TextColumn::make('payment_type')
    ->label('Payment Type')
    ->state(function ($record) {
        return optional($record->transactions->first())->payment_type;
    }),

TextColumn::make('transaction_time')
    ->label('Waktu Transaksi')
    ->state(function ($record) {
        return optional($record->transactions->first())->transaction_time;
    }),

TextColumn::make('bank')
    ->label('Bank')
    ->state(function ($record) {
        return optional($record->transactions->first())->bank;
    }),

TextColumn::make('va_number')
    ->label('VA Number')
    ->state(function ($record) {
        return optional($record->transactions->first())->va_number;
    }),
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
            'index' => Pages\ListPembayaran::route('/'),
        ];
    }
}
