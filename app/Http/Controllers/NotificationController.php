<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Node;
use App\Models\Project;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\RoleInvitation;

class NotificationController extends Controller
{
    public function sendRoleNotification(Request $request, Node $node, User $user) {  
        $project      = Project::findOrFail($request->get('project_id'));
        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();

        Notification::send($user, new RoleInvitation($project, $researchTeam, $user));
   
        route('nodes.explorer.roles', [$node])->with('status', 'Invitación enviada con éxito');
    }
}
