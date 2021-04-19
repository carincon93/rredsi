<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;
use App\Models\Project;
use App\Models\AcademicProgram;
use App\Models\Request as ModelsRequest;
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
    // ? Envio de invitacion para participar en un proyecto
    //**esta la envian los autores invitando a participar a un estudiante */
    public function sendRoleNotification(Request $request , Node $node,User $user ) {
        $project      = Project::findOrFail($request->get('project_id'));
        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        $file = $this->makeDocInvitation($project, $researchTeam, $user);

        Notification::send($user, new RoleInvitation($node, $project, $researchTeam, $user, $file));

        return redirect()->back()->with('status', 'Invitación enviada con éxito');
    }

    // ? Envio de solicitud para participar en un proyecto
    //** esta la envia un estudiante a los autores del proyecto para poder participar */
    public function sendToParticipate(Request $request) {
        // ? usuario que envia solicitud
        $authUser = auth()->user();
        // ? proyecto en el que desea participar
        $project = Project::findOrFail($request->get('project_id'));

        // ! creamos la nueva solicitud y la guardamos
        $requests = new ModelsRequest();
        $requests->user_id              = $authUser->id;
        $requests->type_request         = "Solicitud de participacion en proyecto $project->title";

        $requests->save();

        if ( $authUser->hasRole(4) ) {
            $educationalInstitutionFaculty = $authUser->educationalInstitutionFaculties()->where('is_principal', 1)->first();

            if ($educationalInstitutionFaculty) {
                $node = $educationalInstitutionFaculty->educationalInstitution->node;
                $adminInstitution = $educationalInstitutionFaculty->educationalInstitution->administrator;
            }

        } elseif ( $authUser->hasRole(3) ) {
            $node = $authUser->isEducationalInstitutionAdmin->node;
        }

        $authors = $project->authors;

        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        $node = $request->node;

        $node = json_decode($node);

        // ^ notificamos a los autores de la solicitud de participacion
        Notification::send($authors, new NotificationToParticipate($node, $project, $researchTeam, $authUser,$requests));

        // ^ notificamos a el delegado de la insitucion de la solicitud de participacion
        Notification::send($adminInstitution, new NotificationToParticipate($node, $project, $researchTeam, $authUser,$requests));

        return redirect()->back('nodes.explorer.searchProjects.showProject', [$node->id, $project])->with('status', 'Solicitud enviada con éxito');

    }

    // ? metodo de solicitud para un proyecto poder ingresar en un evento
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

        // ^ notificamos a los autores de la participacion del proyecto en el evento
        #Send authors notification
        Notification::send($authors, new InformationNotification($project, $type));
        // ^ notificamos a delegado(a) de la institucion del registro del proyecto al evento
        #Send admin institution notification
        Notification::send($adminInstitution, new InformationNotification($project, $type));

        return redirect()->back()->with('status', 'Solicitud enviada con éxito');

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

    // ^? index de notificaciones
    public function index()
    {
        $user = auth()->user();

        return view('EducationalInstitutionUsers.index-notifications', compact('user'));
    }

    public function indexAdminInstitution()
    {
        $user = auth()->user();
        $requests = ModelsRequest::get();

        return view('EducationalInstitutionUsers.index-admin-institution', compact('user','requests'));
    }

    // ! index de solicitudes realizadas por cada estudiante
    public function indexRequestStudent()
    {
        $user = auth()->user();
        $requests = ModelsRequest::get()->where('user_id',$user->id);
        // return $requests;

        return view('EducationalInstitutionUsers.index-request-student', compact('user','requests'));
    }


    // ^? este metodo me marca como leidos las notificaciones que llegaron a un correo o se les da clic en el dropdown
    public function indexResponseSend($id)
    {
        $notification = auth()->user()->notifications->find($id);
        $notification->markAsRead();
        $user = auth()->user();

        return view('EducationalInstitutionUsers.index-notifications', compact('user'));
    }

    // ^? este metodo activa el usuario tipo empresa no es una ruta protegida para poder tener acceso a ella
    public function activateUserBusiness($id)
    {
        $user = User::find($id);

        $user->is_enabled = true;
        $user->save();

        return redirect('login')->with('status', 'Usuario activado con exito.');

    }


    public function destroy(Request $request, Notification $notification)
    {
        // $notifications = auth()->user()->notifications;

        // return view('EducationalInstitutionUsers.index-notifications', compact('notifications'));

        // return $notification;
    }

    public function show($id)
    {
        $notification       = auth()->user()->notifications->find($id);
        $notification->markAsRead();

        if(isset($notification->data['student_id'])){
            $user               = User::find($notification->data['student_id']);
            $faculty            = $user->educationalInstitutionFaculties()->where('is_principal', 1)->first();
            $userGraduations    = $user->userGraduations;

            return view('EducationalInstitutionUsers.show-notification', compact('notification', 'user', 'faculty', 'userGraduations'));
        }

        return view('EducationalInstitutionUsers.show-notification', compact('notification'));



    }

    public function showRequest($id)
    {
        $notification       = auth()->user()->notifications->find($id);
        $user               = User::find($notification->data['student_id']);
        $faculty            = $user->educationalInstitutionFaculties()->where('is_principal', 1)->first();
        $userGraduations    = $user->userGraduations;
        $notification->markAsRead();

        $request           = ModelsRequest::findOrFail($notification->data['request_id']);

        return view('EducationalInstitutionUsers.accept-student-project', compact('notification', 'user', 'faculty', 'userGraduations','request'));

    }

    public function acceptStudentInProject(Request $request)
    {
        // dd($request->all());

        $project      = Project::findOrFail($request->get('project_id'));
        $requests     = ModelsRequest::findOrFail($request->get('request_id'));


        $user= User::find($request->get('student_id'));
        $faculty = $user->educationalInstitutionFaculties()->where('is_principal',1)->first();
        $user_educational_institution = $faculty->educationalInstitution->name;

        if($faculty){
            $node = $faculty->educationalInstitution->node;
        }

        // $comment = "";

        // En caso de ser rechazado ingresa a esta condicion
        if($request->get('comment'))
        {
            // $comment es el motivo por el cual es rechazado
            $comment = $request->get('comment');
            $response = "Rechazado(a)";

            // ? actualizamos el status de la solicitud
            $requests->status = 0;
            $requests->comment = $request->get('comment');
            $requests->save();

            Notification::send($user, new RequestResponse($comment, $response, $project));
            return redirect()->back()->with('status', 'Respuesta enviada con éxito');
        }


        // En caso de ser aceptado ingresa a esta condicion
        $response = "Aceptado(a)";
        $researchTeam= $project->researchTeams()->where('is_principal', 1)->first();
        $team_educational_institution = $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name;

        if(!$researchTeam){
            // En caso de no encontrar grupo de investigación sale mensaje de error y no guarda
            return redirect()->back()->with('status', 'El estudiante no se pudo guardar en el grupo de investigación');
        }

        // validamos si usuario pertenece a una institucion diferente a la del grupo de investigación
        $external = false;
        if($user_educational_institution != $team_educational_institution ){
            $external = true;
        }

        // ! SE actualiza la solicitud
        $requests->update([ 'status' => 1]);
        // se agrega a autores del proyecto
        $project->authors()->attach($request->get('student_id'));
        // se agrega al semillero de investigación
        $researchTeam->members()->attach([$request->get('student_id') => ['is_external' => $external,'accepted_at'=> date("Y-m-d H:i:s")]] );
        // se notifica de su aceptación
        Notification::send($user, new RequestResponse("Fue aceptado en el proyecto.", $response, $project));

        return redirect()->back()->with('status', 'Respuesta enviada con éxito');


    }

}
