<?php

namespace App\Policies;

use App\Models\User;
use App\Models\legalInformation;
use Illuminate\Auth\Access\HandlesAuthorization;

class LegalInformationPolicy
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
        if($user->hasPermissionTo('index_legal_information')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function view(User $user)
    {
        if($user->hasPermissionTo('show_legal_information')){
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
        if($user->hasPermissionTo('create_legal_information')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function update(User $user)
    {
        if($user->hasPermissionTo('edit_legal_information')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function delete(User $user)
    {
        if($user->hasPermissionTo('destroy_legal_information')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function restore(User $user, legalInformation $legalInformation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function forceDelete(User $user, legalInformation $legalInformation)
    {
        //
    }
}
