<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationNewBusinessIdea extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$business,$idea)
    {
        $this->user     = $user;
        $this->business = $business;
        $this->idea     = $idea;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject("Creación de una una nueva idea empresarial")
            ->greeting("¡Hola {$notifiable->name} !")
            ->line("Le informamos que una nueva idea empresarial fue generada")
            ->line("Nombre de la idea: {$idea->name}")
            ->line("Empresa: {$business->name}")
            ->line("Usuario encargado: {$user->name}");
    }

    /**
     * Get the arrayrepresentation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "subject"       => "bienvenido al modulo empresarial - Ibis",
            "message"       => "Usted se encuentra activ@ para acceder a toda la información de la plataforma.",
            "thanksMessage" => "Gracias por unirse a nosotros."
        ];
    }
}
