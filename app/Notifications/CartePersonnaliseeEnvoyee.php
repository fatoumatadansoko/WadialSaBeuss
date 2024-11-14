<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

class CartePersonnaliseeEnvoyee extends Notification
{
        use Queueable;
    
        protected $cartePersonnalisee;
        protected $nomInvité; // Ajoute un attribut pour le nom de l'invité
        protected $invite;
        protected $image; // Ajoute une image pour la carte personnalisée
    
        public function __construct($cartePersonnalisee, $nomInvité, $invite, $image)
        {
            $this->invite = $invite; // Stocker l'invité pour l'utiliser dans la vue
            $this->cartePersonnalisee = $cartePersonnalisee;
            $this->nomInvité = $nomInvité; // Stocke le nom de l'invité
           $this->image = $image;
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
                ->line('Contenu : ' . $this->cartePersonnalisee->contenu)
                ->line('image : ' . $this->cartePersonnalisee->image);

                // ->action('Voir la carte', url('/cartes-personnalisees/'.$this->cartePersonnalisee->id))
        }
    }
    

