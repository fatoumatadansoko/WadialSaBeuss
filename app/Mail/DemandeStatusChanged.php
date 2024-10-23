<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $prestataireNom;
    public $etat;
    
    public function __construct($demande,$prestataireNom,$etat)
    {
        $this->demande = $demande;
        $this->prestataireNom = $prestataireNom; // Stocker le nom du prestataire
        $this->etat = $etat; // Stocker l'état de la demande
        

    }

    public function build()
    {
        return $this->view('emails.demande-status-changed')
                    ->subject('Mise à jour de votre demande');
    }
}
