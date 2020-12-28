<?php

namespace App\Policies;

use App\Models\ResearchLine;
use App\Models\User;
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
    public function viewAny(User $user)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('index_research_line')){
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
    public function view(User $user, ResearchLine $researchLine)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('show_research_line')){
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
        if($user->hasPermissionTo('create_research_line')){
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
    public function update(User $user, ResearchLine $researchLine)
    {
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('edit_research_line')){
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
    public function delete(User $user, ResearchLine $researchLine)
    {
         if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('destroy_research_line')){
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
