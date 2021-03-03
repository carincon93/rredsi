<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;
use App\Models\Project;
use App\Models\AcademicProgram;

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

use Illuminate\Support\Facades\Notification;

use App\Notifications\RoleInvitation;
use App\Notifications\InformationNotification;
use App\Notifications\NotificationToParticipate;
use App\Notifications\RequestResponse;


class NotificationController extends Controller
{
    public function sendRoleNotification(Request $request , Node $node,User $user ) {
        $project      = Project::findOrFail($request->get('project_id'));
        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        $file = $this->makeDocInvitation($project, $researchTeam, $user);

        Notification::send($user, new RoleInvitation($node, $project, $researchTeam, $user, $file));

        return redirect()->route('nodes.explorer.roles', [$node])->with('status', 'Invitación enviada con éxito');
    }

    public function sendToParticipate(Request $request) {
        $authUser = auth()->user();

        if ( $authUser->hasRole(4) ) {
            $educationalInstitutionFaculty = $authUser->educationalInstitutionFaculties()->where('is_principal', 1)->first();

            if ($educationalInstitutionFaculty) {
                $node = $educationalInstitutionFaculty->educationalInstitution->node;
            }
        } elseif ( $authUser->hasRole(3) ) {
            $node = $authUser->isEducationalInstitutionAdmin->node;
        }

        $project = Project::findOrFail($request->get('project_id'));
        $authors = $project->authors;

        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        Notification::send($authors, new NotificationToParticipate($node, $project, $researchTeam, $authUser));

        return redirect()->route('nodes.explorer.searchProjects.showProject', [$node, $project])->with('status', 'Solicitud enviada con éxito');
    }

    public function sendProjectToEvent(Request $request) {
        $user       = auth()->user();
        $faculty    = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();

        if($faculty){
            $node = $faculty->educationalInstitution->node;
            $educationalInstitution = $faculty->educationalInstitution;
            $adminInstitution = $educationalInstitution->administrator;
        }

        $project = Project::findOrFail($request->get('project_id'));
        $authors = $project->authors;

        $project->events()->attach($request->get('event_id'));
        $event = $project->events->find($request->get('event_id'));

        $type =[
            "type" => "registrar un proyecto a un evento",
            "name_event" => $event->name
        ];

        #Send authors notification
        Notification::send($authors, new InformationNotification($project, $type));
        #Send admin institution notification
        Notification::send($adminInstitution, new InformationNotification($project, $type));

        return redirect()->route('nodes.explorer.showEvent', [$node, $event])->with('status', 'Solicitud enviada con éxito');

    }

    public function makeDocInvitation($project, $researchTeam, $user)
    {
        $templateProcessor = new TemplateProcessor(url('/storage/templates/contact-template.docx'));

        $city                   = $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->city;
        $dateForHumans          = Carbon::parse(date('Y-m-d'), 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        $authorName             = auth()->user()->name;
        $authorDocumentNumber   = auth()->user()->document_number;
        $title                  = $project->title;
        $educationalInstitution = $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name;
        $userName               = $user->name;
        $researchTeam           = $researchTeam->name;
        $userDocumentNumber     = $user->document_number;
        $url                    = url('/');

        $templateProcessor->setValue('title', $title);
        $templateProcessor->setValue('city', $city);
        $templateProcessor->setValue('dateForHumans', $dateForHumans);
        $templateProcessor->setValue('authorName', $authorName);
        $templateProcessor->setValue('researchTeam', $researchTeam);
        $templateProcessor->setValue('authorDocumentNumber', $authorDocumentNumber);
        $templateProcessor->setValue('educationalInstitution', $educationalInstitution);
        $templateProcessor->setValue('userName', $userName);
        $templateProcessor->setValue('userDocumentNumber', $userDocumentNumber);
        $templateProcessor->setValue('url', $url);

        $appName        = config('app.name');
        $year           = date('Y');
        $fileName       = "$appName-$project->id-$year-$userDocumentNumber.docx";
        $storagePath    = storage_path("app/public/role-requests/$fileName");

        if (!Storage::disk('public')->exists("/role-requests/$fileName")) {
            $templateProcessor->saveAs($storagePath);
        }

        return $storagePath;
    }

    public function index()
    {
        $user = auth()->user();

        return view('EducationalInstitutionUsers.index-notifications', compact('user'));
    }

    public function indexResponseSend($id)
    {
        $notification = auth()->user()->notifications->find($id);
        $notification->markAsRead();
        $user = auth()->user();

        return view('EducationalInstitutionUsers.index-notifications', compact('user'));
    }


    public function destroy(Request $request, Notification $notification)
    {
        // $notifications = auth()->user()->notifications;

        // return view('EducationalInstitutionUsers.index-notifications', compact('notifications'));

        // return $notification;
    }

    public function show($id)
    {
        $notification = auth()->user()->notifications->find($id);

        $user= User::find($notification->data['student_id']);
        $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();
        $userGraduations = $user->userGraduations;
        $notification->markAsRead();

        return view('EducationalInstitutionUsers.show-notifications', compact('notification','user','faculty','userGraduations'));

    }


    public function acceptStudent(Request $request)
    {
        $project      = Project::findOrFail($request->get('project_id'));

        $user= User::find($request->get('student_id'));
        $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();
        $user_educational_institution = $faculty->educationalInstitution->name;

        if($faculty){
            $node = $faculty->educationalInstitution->node;
        }

        $datos = "";

        // En caso de ser rechazado ingresa a esta condicion
        if($request->get('datos'))
        {
            // $datos es el motivo por el cual es rechazado
            $datos = $request->get('datos');
            $response = "Rechazado(a)";

            Notification::send($user, new RequestResponse($datos, $response, $project));
            return redirect()->route('nodes.explorer.roles', [$node])->with('status', 'Respuesta enviada con éxito');
        }


        // En caso de ser aceptado ingresa a esta condicion
        $response = "Aceptado(a)";
        $researchTeam= $project->researchTeams()->where('is_principal',1)->first();
        $team_educational_institution = $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name;

        if($researchTeam){

            // validamos si usuario pertenece a una institucion diferente a la de el grupo de investigación
            $external = false;
            if($user_educational_institution != $team_educational_institution ){
                $external = true;
            }

            // se agrega a autores de el proyecto
            $project->authors()->attach($request->get('student_id'));
            // se agrega a el grupo de investigación
            $researchTeam->members()->attach($request->get('student_id'), array('is_external' => $external,'accepted_at'=> date("Y-m-d H:i:s")) );
            // se notifica de su aceptación
            Notification::send($user, new RequestResponse($datos, $response, $project));

            return redirect()->route('nodes.explorer.roles', [$node])->with('status', 'Respuesta enviada con éxito');

        }

        // En caso de no encontrar grupo de investigación sale mensaje de error y no guarda
        return redirect()->route('nodes.explorer.roles', [$node])->with('status', 'El estudiante no se pudo guardar en el grupo de investigación');
    }

}
