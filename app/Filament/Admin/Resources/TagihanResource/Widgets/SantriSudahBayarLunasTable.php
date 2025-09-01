<?php 
namespace App\Filament\Admin\Resources\TagihanResource\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class SantriSudahBayarLunasTable extends BaseWidget
{
    protected static ?string $heading = 'Santri Sudah Bayar Lunas';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->withCount([
                        'pembayaran as jumlah_berhasil' => fn($q) => $q->where('status', 'berhasil'),
                        'pembayaran as jumlah_menunggu' => fn($q) => $q->where('status', 'menunggu'),
                    ])
                    ->havingRaw('jumlah_berhasil > 0 AND jumlah_berhasil = (jumlah_berhasil + jumlah_menunggu)')
            )
            ->columns([
                TextColumn::make('name')->label('Nama Santri')->searchable()->sortable(),
                TextColumn::make('jumlah_berhasil')->label('Pembayaran Berhasil')->sortable(),
                TextColumn::make('jumlah_menunggu')->label('Pembayaran Menunggu')->sortable(),
            ])
            ->paginated(true);
    }
}
