<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UploadBerkas extends Model
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
        'berkas_fc_sttb',
        'berkas_skhun',
        'berkas_pas_foto',
        'berkas_akte_kelahiran',
        'berkas_blangko_pendaftaran',
        'berkas_nisn',
        'berkas_kartu_keluarga',
        'status',
    ];
}
