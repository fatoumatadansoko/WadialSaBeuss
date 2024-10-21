<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Commentaire;

class CommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Commentaire $comment)
    {
        $this->comment = $comment;
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
                ->subject('Nouveau Commentaire reçu')
                ->greeting('Bonjour ' . $notifiable->nom)
                ->line('Vous avez reçu un nouveau commentaire de la part d\'un client.')
                ->line('Commentaire: ' . $this->comment->contenu)
                ->action('Voir le commentaire', url('/comments/' . $this->comment->id))
                ->line('Merci d\'utiliser notre plateforme!');
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
            'comment_id' => $this->comment->id,
            'content' => $this->comment->content,
        ];
    }
}
