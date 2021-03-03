<?php

namespace App\Policies;

use App\Models\EducationalInstitution;
use App\Models\EducationalInstitutionEvent;
use App\Models\Node;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationalInstitutionEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution_event')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
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
     * @param  \App\Models\EducationalInstitutionEvent  $educationalInstitutionEvent
     * @return mixed
     */
    public function view(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution_event')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
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
    public function create(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution_event')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
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
     * @param  \App\Models\EducationalInstitutionEvent  $educationalInstitutionEvent
     * @return mixed
     */
    public function update(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution_event')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
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
     * @param  \App\Models\EducationalInstitutionEvent  $educationalInstitutionEvent
     * @return mixed
     */
    public function delete(User $user, Node $node, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_educational_institution_event')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
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
     * @param  \App\Models\EducationalInstitutionEvent  $educationalInstitutionEvent
     * @return mixed
     */
    public function restore(User $user, EducationalInstitutionEvent $educationalInstitutionEvent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionEvent  $educationalInstitutionEvent
     * @return mixed
     */
    public function forceDelete(User $user, EducationalInstitutionEvent $educationalInstitutionEvent)
    {
        //
    }
}
