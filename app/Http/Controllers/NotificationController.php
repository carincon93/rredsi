<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;
use App\Models\Project;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\RoleInvitation;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function sendRoleNotification(Request $request, Node $node, User $user) {  
        $project      = Project::findOrFail($request->get('project_id'));
        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        $file = $this->makeDocInvitation($project, $researchTeam, $user);

        Notification::send($user, new RoleInvitation($node, $project, $researchTeam, $user, $file));
   
        return redirect()->route('nodes.explorer.roles', [$node])->with('status', 'Invitación enviada con éxito');
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

    public function getAllNotifications() {
        $notifications = auth()->user()->notifications;

        return view('EducationalInstitutionUsers.index-notifications', compact('notifications'));
    }
}
