<?php

namespace App\Policies;

use App\Models\ResearchOutput;
use App\Models\User;
use App\Models\ResearchTeam;
use App\Models\EducationalInstitution;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;

class ResearchOutputPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
       if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_research_output')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        if($project->authors()->where('user_id', $user->id)->first()){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchOutput  $researchOutput
     * @return mixed
     */
    public function view(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
       if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('show_research_output')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        if($project->authors()->where('user_id', $user->id)->first()){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
       if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('create_research_output')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        if($project->authors()->where('user_id', $user->id)->first()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchOutput  $researchOutput
     * @return mixed
     */
    public function update(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
       if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('edit_research_output')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        if($project->authors()->where('user_id', $user->id)->first()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchOutput  $researchOutput
     * @return mixed
     */
    public function delete(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
       if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('destroy_research_output')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        if($project->authors()->where('user_id', $user->id)->first()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchOutput  $researchOutput
     * @return mixed
     */
    public function restore(User $user, ResearchOutput $researchOutput)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchOutput  $researchOutput
     * @return mixed
     */
    public function forceDelete(User $user, ResearchOutput $researchOutput)
    {
        //
    }
}
