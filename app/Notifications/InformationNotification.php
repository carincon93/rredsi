<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data,$type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->type == "proyecto" || $this->type == "producto de investigación"){
            $name = $this->data->title;
            $message = " el nuevo ";
        }else if($this->type =="institución educativa"){
            $name = $this->data->name;
            $message = " la nueva ";
        }else{
            $name = $this->data->name;
            $message = " el nuevo ";
        }

        if(isset($this->type['type'])){
            return [
                "subject"       => "Se acaba de {$this->type['type']} - Ibis",
                "message"       => "Hola {$notifiable->name} se registró el proyecto {$this->data->title} al evento {$this->type['name_event']}.",
                "thanksMessage" => "Gracias por su atención."
            ];
        }else if(isset($this->type['annualEventResponse'])){
            return [
                "subject"       => "{$this->type['case']} - Ibis",
                "message"       => "¡Hola {$notifiable->name}! la participacion del proyecto {$this->data->title } al evento anual fue {$this->type['annualEventResponse']} por motivos {$this->type['comments']}  .",
                "thanksMessage" => "Agradecemos su participación."
            ];
        }else{
            return [
                "subject"       => "Se acaba de crear {$message} {$this->type} - Ibis",
                "message"       => "Hola {$notifiable->name} te invitamos a que conozcas {$message} {$this->type} {$name}.",
                "thanksMessage" => "Gracias por su atención."
            ];
        }

    }
}
