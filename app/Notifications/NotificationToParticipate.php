<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationToParticipate extends Notification
{
    use Queueable;

    private $node;
    private $project;
    private $researchTeam;
    private $user;
    private $file;
    /**

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($node, $project, $researchTeam, $user)
    {
        $this->node         = $node;
        $this->project      = $project;
        $this->researchTeam = $researchTeam;
        $this->user         = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Quemado Falta mail
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
        if ( $this->user->hasRole(4) ) {
            $educationalInstitutionFaculty  = $this->user->educationalInstitutionFaculties()->where('is_principal',1)->first();
            $educationalInstitution         = $educationalInstitutionFaculty->educationalInstitution->name;
        } elseif ( $this->user->hasRole(3) ) {
            $educationalInstitution = $this->user->isEducationalInstitutionAdmin;
        }

        return (new MailMessage)
                ->subject("Solicitud de participación en proyecto de {$this->project->projectType->type} - Ibis")
                ->greeting("¡Hola {$notifiable->name} !")
                ->line("El estudiante {$this->user->name} de la institución educativa {$educationalInstitution} desea participar en el desarrollo del proyecto {$this->project->title}'.")
                ->action('Más información del estudiante', route('notifications.indexResponseSend', [$this->id]))
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
        if ( $this->user->hasRole(4) ) {
            $educationalInstitutionFaculty  = $this->user->educationalInstitutionFaculties()->where('is_principal',1)->first();
            $educationalInstitution         = $educationalInstitutionFaculty->educationalInstitution->name;
        } elseif ( $this->user->hasRole(3) ) {
            $educationalInstitution = $this->user->isEducationalInstitutionAdmin;
        }

        return [
            "subject"       => "Solicutud de participación en proyecto de {$this->project->projectType->type} - Ibis",
            "message"       => "El estudiante {$this->user->name} de la institución educativa {$educationalInstitution} quiere solicitar la participación en el desarrollo del proyecto {$this->project->title}'.",
            "action"        => route('notifications.indexResponseSend', [$this->id]),
            "student_id"    => $this->user->id,
            "project_id"    => $this->project->id,
            "thanksMessage" => "Gracias y espero su pronta respuesta!'"
        ];
    }
}
