<?php

namespace App\Policies;

use App\Models\ProjectType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectTypePolicy
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
        if($user->hasRole('Administrador','Coordinador')){
            return true;
        }
        // if($user->hasPermissionTo('index_project')){
        //     return true;
        // }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectType  $projectType
     * @return mixed
     */
    public function view(User $user, ProjectType $projectType)
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
     * @param  \App\Models\ProjectType  $projectType
     * @return mixed
     */
    public function update(User $user, ProjectType $projectType)
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
     * @param  \App\Models\ProjectType  $projectType
     * @return mixed
     */
    public function delete(User $user, ProjectType $projectType)
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
     * @param  \App\Models\ProjectType  $projectType
     * @return mixed
     */
    public function restore(User $user, ProjectType $projectType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProjectType  $projectType
     * @return mixed
     */
    public function forceDelete(User $user, ProjectType $projectType)
    {
        //
    }
}
