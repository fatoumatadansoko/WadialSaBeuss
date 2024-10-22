<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CartePersonnaliseeEnvoyee extends Notification
{
        use Queueable;
    
        protected $cartePersonnalisee;
        protected $nomInvité; // Ajoute un attribut pour le nom de l'invité
        protected $invite;
    
        public function __construct($cartePersonnalisee, $nomInvité, $invite)
        {
            $this->invite = $invite; // Stocker l'invité pour l'utiliser dans la vue
            $this->cartePersonnalisee = $cartePersonnalisee;
            $this->nomInvité = $nomInvité; // Stocke le nom de l'invité
        }
    
        public function via($notifiable)
        {
            return ['mail'];
        }
    
        public function toMail($notifiable)
        {
            return (new MailMessage)
                ->subject('Vous avez reçu une invitation !')
                ->greeting('Bonjour ' . $this->nomInvité . ',') // Utilise le nom de l'invité ici
                ->line('On serait ravi de vous compter parmi les invités pour ' . $this->cartePersonnalisee->nom)
                ->line('Carte : ' . $this->cartePersonnalisee->nom)
                ->line('Contenu : ' . $this->cartePersonnalisee->contenu);
                // ->action('Voir la carte', url('/cartes-personnalisees/'.$this->cartePersonnalisee->id))
        }
    }
    

