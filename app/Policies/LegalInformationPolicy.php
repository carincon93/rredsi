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
        if($user->hasRole(['Administrador','Coordinador'])){
            return true;
        }
        // if($user->hasPermissionTo('Administrador')){
        //     return true;
        // }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\legalInformation  $legalInformation
     * @return mixed
     */
    public function view(User $user, legalInformation $legalInformation)
    {
        if($user->hasRole('Administrador','Coordinador')){
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
        if($user->hasRole('Administrador','Coordinador')){
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
    public function update(User $user, legalInformation $legalInformation)
    {
        if($user->hasRole('Administrador','Coordinador')){
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
    public function delete(User $user, legalInformation $legalInformation)
    {
        if($user->hasRole('Administrador','Coordinador')){
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
