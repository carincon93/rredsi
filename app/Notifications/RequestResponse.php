<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestResponse extends Notification
{
    use Queueable;

    private $project;
    private $comment;
    private $response;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $response, $project)
    {
        $this->comment         = "Motivos : ".$comment;
        $this->response      = $response;
        $this->project       = $project;

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
            ->subject("Respuesta a la solicitud de participación en proyecto de {$this->project->projectType->type} - Ibis")
            ->greeting("¡Hola {$notifiable->name} !")
            ->line("Le informamos que su solicitud de participacion realizada al proyecto {$this->project->title} fue {$this->response}. $this->comment.")
            ->action('Más información de la respuesta', route('notifications.indexResponseSend', [$this->id]))
            ->line('Gracias por enviarnos la solicitud.');
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
            "subject"       => "Respuesta a solicutud de participación en proyecto de {$this->project->projectType->type} - Ibis",
            "message"       => "Le informamos que su solicitud de participacion realizada al proyecto {$this->project->title} fue {$this->response}. $this->comment.",
            "action"        => route('notifications.indexResponseSend', [$this->id]),
            "thanksMessage" => "Gracias por enviarnos la solicitud."
        ];
    }
}
