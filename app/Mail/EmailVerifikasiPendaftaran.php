<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerifikasiPendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    // EmailVerifikasiPendaftaran.php
    public ?string $nama_lengkap;
    public ?string $email;
    public ?string $no_hp;
    public ?string $alamat;
    public ?string $verification_token;

    public function __construct($pendaftar)
    {
        $this->nama_lengkap = $pendaftar->nama_lengkap;
        $this->email = $pendaftar->email;
        $this->no_hp = $pendaftar->no_hp;
        $this->alamat = $pendaftar->alamat;
        $this->verification_token = $pendaftar->verification_token;
    }

    public function build()
    {
        return $this->subject('Verifikasi Email Pendaftaran')
            ->view('emails.verifikasi')
            ->with([
                'nama' => $this->nama_lengkap,
                'url'  => url('/verifikasi/' . $this->verification_token),
            ]);
    }



}
