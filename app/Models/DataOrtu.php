<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class DataOrtu extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_ayah',
        'nik_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'nik_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'no_hp_ayah',
        'no_hp_ibu',
    ];
}
