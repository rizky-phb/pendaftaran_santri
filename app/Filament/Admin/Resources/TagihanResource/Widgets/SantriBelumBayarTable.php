<?php

namespace App\Filament\Admin\Resources\TagihanResource\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class SantriBelumBayarTable extends BaseWidget
{
    protected static ?string $heading = 'Santri Belum Bayar';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    // pengguna yang masih punya tagihan pending
                    ->whereHas('pembayaran', fn ($q) => $q->where('status', 'menunggu'))
                    // opsional: tampilkan total semua pembayaran (atau bisa hitung pending saja)
                    ->withCount('pembayaran')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Username / Nama Santri')
                    ->searchable()
                    ->sortable(),
                // total semua tagihan; kalau mau hanya pending, pakai withCount alias (lihat catatan di bawah)
                TextColumn::make('pembayaran_count')
                    ->label('Total Tagihan')
                    ->sortable(),
            ])
            ->paginated(true);
    }
}