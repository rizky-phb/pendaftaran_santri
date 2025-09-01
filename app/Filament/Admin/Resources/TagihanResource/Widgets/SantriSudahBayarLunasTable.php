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
                    ->whereHas('pembayaran', fn ($q) => $q->where('status', 'berhasil'))
                    ->withSum(['pembayaran as total_lunas' => fn($q) => $q->where('status', ['berhasil', 'menunggu'])], 'jumlah')
            )
            ->columns([
                TextColumn::make('name')->label('Nama Santri')->searchable()->sortable(),
                TextColumn::make('total_lunas')
                    ->label('Total Dibayar')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->paginated(true);
    }
}
