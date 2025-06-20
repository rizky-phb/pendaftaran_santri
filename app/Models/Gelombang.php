<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gelombang extends Model
{

    protected $table = 'gelombang'; // ← Tambahkan ini
    use HasFactory;
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'gelombang',
    ];


}
