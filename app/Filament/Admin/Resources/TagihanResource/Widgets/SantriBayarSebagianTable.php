<?php
namespace App\Filament\Admin\Resources\TagihanResource\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class SantriBayarSebagianTable extends BaseWidget
{
    protected static ?string $heading = 'Santri Bayar Sebagian';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->whereHas('pembayaran', fn ($q) => $q->where('status', 'berhasil'))
                    ->withSum(['pembayaran as total_dibayar' => fn($q) => $q->where('status', 'berhasil')], 'jumlah')
                    ->withSum(['pembayaran as total_tagihan' => fn($q) => $q->whereIn('status', ['berhasil', 'menunggu'])], 'jumlah')
            )
            ->columns([
                TextColumn::make('name')->label('Nama Santri')->searchable()->sortable(),
                TextColumn::make('total_dibayar')
                    ->label('Sudah Dibayar')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('total_tagihan')
                    ->label('Total Tagihan')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('sisa_bayar')
                    ->label('Sisa Tagihan')
                    ->getStateUsing(fn ($record) => $record->total_tagihan - $record->total_dibayar)
                    ->money('IDR'),
            ])
            ->paginated(true);
    }
}
