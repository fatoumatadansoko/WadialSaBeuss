<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
         // Assurez-vous que le chemin de la vue est correct
         return $this->subject('Test d\'envoi d\'email')
         ->view('emails.test'); // Chemin vers la vue 'emails/test.blade.php'
}
}
