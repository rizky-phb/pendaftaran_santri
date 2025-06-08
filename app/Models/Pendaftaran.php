<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
    ];
}
