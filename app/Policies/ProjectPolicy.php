<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Models\ResearchTeam;
use App\Models\EducationalInstitution;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('index_project')){
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

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function view(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('show_project')){
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
    public function create(User $user,EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('create_project')){
            return true;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function update(User $user, EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('edit_project')){
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
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function delete(User $user, EducationalInstitution $educationalInstitution, ResearchTeam $researchTeam, Project $project)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        $adminTeam = $researchTeam->administrator->id;
        if($adminTeam == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
