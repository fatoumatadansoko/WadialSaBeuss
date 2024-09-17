<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Vote;

class VoteNotification extends Notification
{
    use Queueable;

    protected $vote;

    /**
     * Create a new notification instance.
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Utilisez 'database' si vous voulez stocker la notification dans la base de données
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouveau Vote')
                    ->line('Vous avez reçu un nouveau vote.')
                    ->line('Note: ' . $this->vote->rating)
                    ->action('Voir Vote', url('/votes/' . $this->vote->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'vote_id' => $this->vote->id,
            'rating' => $this->vote->rating,
        ];
    }
}
