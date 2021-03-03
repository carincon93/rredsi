<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        $authUser = Auth::user();

        // dd($authUser->isNodeAdmin);

        switch ($authUser) {
            case $authUser->hasRole(1):
                return redirect()->route('nodes.dashboard', [$authUser->my_projects['node']]);
            break;

            case $authUser->hasRole(2):
                return redirect()->route('nodes.dashboard', [$authUser->isNodeAdmin->id]);
            break;

            case $authUser->hasRole(3):
                return redirect()->route('nodes.educational-institutions.dashboard', [$authUser->isEducationalInstitutionAdmin->node->id, $authUser->isEducationalInstitutionAdmin->id]);
            break;

            case $authUser->hasRole(4):

                if ( !is_null($authUser->my_projects ) ) {
                    $node                             = $authUser->my_projects['node'];
                    $educationalInstitution           = $authUser->my_projects['educationalInstitution'];
                    $educationalInstitutionFaculty    = $authUser->my_projects['educationalInstitutionFaculty'];
                    $researchGroup                    = $authUser->my_projects['researchGroup'];
                    $researchTeam                    = $authUser->my_projects['researchTeam'];
                }

                return redirect()->route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects', [$node, $educationalInstitution, $educationalInstitutionFaculty, $researchGroup, $researchTeam]);

            break;

            default:
                return redirect()->route('/');
            break;
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}
