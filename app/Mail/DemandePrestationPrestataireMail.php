<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandePrestationPrestataireMail extends Mailable
{
    use Queueable, SerializesModels;

    public $prestataire;
    public $client;

    /**
     * Crée une nouvelle instance du Mailable.
     *
     * @param $prestataire
     * @param $client
     */
    public function __construct($prestataire, $client)
    {
        $this->prestataire = $prestataire;
        $this->client = $client;
    }

    /**
     * Crée le message pour le prestataire.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouvelle demande de prestation')
                    ->view('emails.demande_prestation_prestataire') // Assurez-vous que cette vue existe
                    ->with([
                        'prestataire' => $this->prestataire,
                        'client' => $this->client,
                    ]);
    }
}
