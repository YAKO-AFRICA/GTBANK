<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class myNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle Notification')
            ->greeting('Bonjour!')
            ->line($this->details['message'])
            ->action('Voir les détails', url('/'))
            ->line('Merci de nous faire confiance!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'url' => $this->details['url'],
            'title' => $this->details['title'],
            'user' => $this->details['user'],      // Ajout de l'utilisateur
            'date' => $this->details['date'],  // Ajout de l'action
            'message' => $this->details['message'] // Ajout du message, si vous l'avez ajouté
        ];
    }
    
}
