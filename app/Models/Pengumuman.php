<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{

    protected $table = 'pengumuman'; // ← Tambahkan ini
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'gelombang',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
