<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class NotificationInteres extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$business,$project,$authors)
    {
        $this->user = $user;
        $this->business = $business;
        $this->project = $project;
        $this->authors = $authors;

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
        $authorArray = [];
        $authorText= "nombre : name, telefono: phone_number, correo: email ";

        foreach ($this->authors as $author) {
            
            $test= str_replace("name",$author->name,$authorText);
            $test= str_replace("phone_number","$author->cellphone_number",$test  );
            $test= str_replace("email", $author->email,$test );
            array_push($authorArray,$test);
        }
        $investigadores = implode(", .\n",$authorArray);

        return (new MailMessage)
            ->subject("Se ha generado un nuevo interes en un proyecto de la institucion")
            ->greeting("¡Hola {$notifiable->name} !")
            ->line("Datos de la Empresa: ")
            ->line("Empresa interesada: {$this->business->name}.")
            ->line("Nombre del encargado: {$this->user->name}.")
            ->line("Correo electronico del responsable: {$this->user->email}")
            ->line("Numero del responsable: {$this->user->cellphone_number}")
            ->line("Datos del proyecto:")
            ->line("Nombre del proyecto de interes: {$this->project->title}")
            ->line("Datos del investigador:")
            ->line("{$investigadores}")
            ->line('Gracias y espero su pronta respuesta');
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
            "subject"       =>"Se ha generado un nuevo interes {$this->project->title}",
            "message"       => "El estudiante {$this->user->name} de la institución educativa  quiere solicitar la participación en el desarrollo del proyecto {$this->project->title}'.",
            "thanksMessage" => "Gracias y espero su pronta respuesta!'"
        ];
    }
}
