<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandePrestationClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $prestataire;
    public $client;

    public function __construct($prestataire, $client)
    {
        $this->prestataire = $prestataire;
        $this->client = $client;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre demande de prestation')
        ->view('emails.demande_prestation_client') // Utilisation correcte de la vue
        ->with([
            'prestataire' => $this->prestataire,
            'client' => $this->client,
        ]);
}
}
