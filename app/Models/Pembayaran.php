<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'jenis_pembayaran',
        'jumlah',
        'tanggal_bayar',
        'status',
        'bukti_transfer',
    ];
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
public function transactions()
{
    return $this->belongsToMany(Transaction::class, 'pembayaran_transaction');
}


}
