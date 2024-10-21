<?php 
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class DemandeNotification extends Notification
{
    use Queueable;
    use Notifiable;

    private $demandeDetails;

    public function __construct($demandeDetails)
    {
        $this->demandeDetails = $demandeDetails;
    }

    // Canaux de notification
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Structure de la notification pour l'email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande de prestation')
            ->line('Vous avez reçu une nouvelle demande de prestation de la part de ' . $this->demandeDetails['email'])
            ->line('Message : ' . $this->demandeDetails['message'])
            ->line('Merci d\'utiliser notre plateforme !');
    }
    
    public function toArray($notifiable)
    {
        return [
            dd( $this->demandeDetails['email']),
            'user_id' => $this->demandeDetails['user_id'],
            'email' => $this->demandeDetails['email'] ?? null, // Assurez-vous que 'email' est défini dans $demandeDetails
        ];
    }
}
