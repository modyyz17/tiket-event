<?php

namespace App\Mail;

namespace App\Mail;

use App\Models\Tiket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TiketBerhasilDibeli extends Mailable
{
    use Queueable, SerializesModels;

    public $tiket;

    public function __construct(Tiket $tiket)
    {
        $this->tiket = $tiket;
    }

    public function build()
    {
        return $this->subject('Tiket Kamu Berhasil Dipesan!')
                    ->view('emails.tiket');
    }
}
