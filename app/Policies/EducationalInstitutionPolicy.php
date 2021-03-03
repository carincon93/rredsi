<?php

namespace App\Policies;

use App\Models\EducationalInstitution;
use App\Models\User;
use App\Models\Node;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationalInstitutionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution')){
            return false;
        }

        $admin = $node->administrator->id;

        if($admin == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return mixed
     */
    public function view(User $user, Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('show_educational_institution')){
            return false;
        }

        $admin = $node->administrator->id;

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
    public function create(User $user, Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('create_educational_institution')){
            return false;
        }
        $admin = $node->administrator->id;
        if($admin == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return mixed
     */
    public function update(User $user, Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('edit_educational_institution')){
            return false;
        }
        $admin = $node->administrator->id;
        if($admin == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return mixed
     */
    public function delete(User $user, Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('destroy_educational_institution')){
            return false;
        }
        $admin = $node->administrator->id;
        if($admin == $user->id){
            return true;
        }
        return false;
    }

    public function isAdmin(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }

        if($educationalInstitution->administrator_id == $user->id){
            return true;
        }

        $admin = $node->administrator->id;
        if($admin == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return mixed
     */
    public function restore(User $user, EducationalInstitution $educationalInstitution)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitution  $educationalInstitution
     * @return mixed
     */
    public function forceDelete(User $user, EducationalInstitution $educationalInstitution)
    {
        //
    }
}
