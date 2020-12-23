<?php

namespace App\Policies;

use App\Models\EducationalInstitutionEvent;
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
    public function viewAny(User $user)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('index_educational_institution_events')){
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
    public function view(User $user, EducationalInstitutionEvent $educationalInstitutionEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('index_educational_institution_events')){
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
    public function create(User $user)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('create_educational_institution_events')){
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
    public function update(User $user, EducationalInstitutionEvent $educationalInstitutionEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('edit_educational_institution_events')){
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
    public function delete(User $user, EducationalInstitutionEvent $educationalInstitutionEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('destroy_educational_institution_events')){
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
