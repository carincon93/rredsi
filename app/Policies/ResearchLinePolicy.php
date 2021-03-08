<?php

namespace App\Policies;

use App\Models\ResearchLine;
use App\Models\User;
use App\Models\EducationalInstitution;

use Illuminate\Auth\Access\HandlesAuthorization;

class ResearchLinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user,EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_research_line')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchLine  $researchLine
     * @return mixed
     */
    public function view(User $user,EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('show_research_line')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
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
    public function create(User $user,EducationalInstitution $educationalInstitution)
    {
         if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('create_research_line')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchLine  $researchLine
     * @return mixed
     */
    public function update(User $user,EducationalInstitution $educationalInstitution)
    {
         if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('edit_research_line')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchLine  $researchLine
     * @return mixed
     */
    public function delete(User $user,EducationalInstitution $educationalInstitution)
    {
         if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('destroy_research_line')){
            return false;
        }
        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchLine  $researchLine
     * @return mixed
     */
    public function restore(User $user, ResearchLine $researchLine)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ResearchLine  $researchLine
     * @return mixed
     */
    public function forceDelete(User $user, ResearchLine $researchLine)
    {
        //
    }
}
