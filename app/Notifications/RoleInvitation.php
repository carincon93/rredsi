<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoleInvitation extends Notification
{
    use Queueable;

    private $node;
    private $project;
    private $researchTeam;
    private $user;
    private $file;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($node, $project, $researchTeam, $user, $file)
    {
        $this->node         = $node;
        $this->project      = $project;
        $this->researchTeam = $researchTeam;
        $this->user         = $user;
        $this->file         = $file;
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
                    ->subject("Invitación de participación en proyecto de {$this->project->projectType->type} - Ibis")
                    ->greeting("¡Hola {$this->user->name}!")
                    ->line("El semillero de investigación {$this->researchTeam->name} de la institución educativa {$this->researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name} quiere invitarlo para que participe en el desarrollo del proyecto {$this->project->title}. Por favor revise el documento adjunto, si esta de acuerdo firme y posteriormente cargar el documento en pdf en la sección 'Enviar respuesta' haciendo clic en 'Más información del proyecto'.")
                    ->action('Más información del proyecto', route('nodes.explorer.searchProjects.showProject', [$this->node, $this->project]))
                    ->line('Gracias y esperamos su pronta respuesta')
                    ->attach($this->file);
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
            "subject"       => "Invitación de participación en proyecto de {$this->project->projectType->type} - Ibis",
            "message"       => "El semillero de investigación {$this->researchTeam->name} de la institución educativa {$this->researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name} quiere invitarlo para que participe en el desarrollo del proyecto {$this->project->title}. Por favor revise el documento adjunto, si esta de acuerdo firme y posteriormente cargar el documento en pdf en la sección 'Enviar respuesta' haciendo clic en 'Más información del proyecto'.",
            "action"        => route('nodes.explorer.searchProjects.showProject', [$this->node, $this->project]),
            "thanksMessage" => "Gracias y esperamos su pronta respuesta!'"
        ];
    }
}
