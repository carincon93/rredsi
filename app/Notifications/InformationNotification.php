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
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->type == "Proyecto" || $this->type == "Producto de investigación"){
            $name = $this->data->title;
            $message = " el nuevo ";
        }else if($this->type =="Institución educativa"){
            $name = $this->data->name;
            $message = " la nueva ";
        }else{
            $name = $this->data->name;
            $message = " el nuevo ";
        }

        if(isset($this->type['type'])){
            return [
                "subject"       => "Se acaba de registrar un proyecto a un evento- Ibis",
                "message"       => "Hola {$notifiable->name} se registro el proyecto {$this->data->title} a el evento {$this->type['name_event']}.",
                "thanksMessage" => "Gracias por tu atención !"
            ];
        }else{
            return [
                "subject"       => "Se acaba de crear un nuevo {$this->type} - Ibis",
                "message"       => "Hola {$notifiable->name} te invitamos a que conozcas {$message} {$this->type} {$name}.",
                "thanksMessage" => "Gracias por tu atención !"
            ];
        }

    }
}
