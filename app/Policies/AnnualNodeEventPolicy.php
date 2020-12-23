<?php

namespace App\Policies;

use App\Models\AnnualNodeEvent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnualNodeEventPolicy
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
        if($user->hasPermissionTo('index_annual_node_events')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function view(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('index_annual_node_events')){
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
        if($user->hasPermissionTo('create_annual_node_events')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function update(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('edit_annual_node_events')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function delete(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('destroy_annual_node_events')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function restore(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function forceDelete(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        //
    }
}
