<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAcademicWork;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAcademicWorkPolicy
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
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('index_academic_work')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserAcademicWork  $userAcademicWork
     * @return mixed
     */
    public function view(User $user, UserAcademicWork $userAcademicWork)
    {
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('show_academic_work')){
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
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('create_academic_work')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserAcademicWork  $userAcademicWork
     * @return mixed
     */
    public function update(User $user, UserAcademicWork $userAcademicWork)
    {
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('edit_academic_work')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserAcademicWork  $userAcademicWork
     * @return mixed
     */
    public function delete(User $user, UserAcademicWork $userAcademicWork)
    {
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('destroy_academic_work')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserAcademicWork  $userAcademicWork
     * @return mixed
     */
    public function restore(User $user, UserAcademicWork $userAcademicWork)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserAcademicWork  $userAcademicWork
     * @return mixed
     */
    public function forceDelete(User $user, UserAcademicWork $userAcademicWork)
    {
        //
    }
}
