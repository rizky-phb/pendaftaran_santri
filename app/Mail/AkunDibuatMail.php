<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AkunDibuatMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public string $nama;
    public string $email;
    public string $password;

    public function __construct(string $nama, string $email, string $password)
    {
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Akun Anda Telah Dibuat')
            ->view('emails.akun-dibuat');
    }


}
