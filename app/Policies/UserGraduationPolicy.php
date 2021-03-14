<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserGraduation;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGraduationPolicy
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
        if($user->hasPermissionTo('index_graduation')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGraduation  $userGraduation
     * @return mixed
     */
    public function view(User $user, UserGraduation $userGraduation)
    {
        if($user->hasPermissionTo('show_graduation')){
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
        if($user->hasPermissionTo('create_graduation')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGraduation  $userGraduation
     * @return mixed
     */
    public function update(User $user, UserGraduation $userGraduation)
    {
        if($user->hasPermissionTo('edit_graduation')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGraduation  $userGraduation
     * @return mixed
     */
    public function delete(User $user, UserGraduation $userGraduation)
    {
        if($user->hasPermissionTo('destroy_graduation')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGraduation  $userGraduation
     * @return mixed
     */
    public function restore(User $user, UserGraduation $userGraduation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGraduation  $userGraduation
     * @return mixed
     */
    public function forceDelete(User $user, UserGraduation $userGraduation)
    {
        //
    }
}
