<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'amount',
        'status',
        'payment_type',
        'transaction_time',
        'transaction_id',
        'pembayaran_id',
        'transaction_status',
        'fraud_status',
        'bank',
        'va_number',
        'status_message',
        'pdf_url',
    ];
    public function pembayarans()
    {
        return $this->belongsToMany(Pembayaran::class, 'pembayaran_transaction');
    }


}
