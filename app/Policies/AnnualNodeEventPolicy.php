<?php

namespace App\Policies;

use App\Models\AnnualNodeEvent;
use App\Models\User;
use App\Models\Node;
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
        // if(!$user->hasPermissionTo('index_annual_node_events')){
        //     return false;
        // }
        // $admin = $node->administrator->id;

        if($user->isNodeAdmin){
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
    public function view(User $user, Node $node)
    {
        if(!$user->hasPermissionTo('index_annual_node_events')){
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
    public function create(User $user)
    {
        if(!$user->hasPermissionTo('create_annual_node_events')){
            return false;
        }

         false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function update(User $user, Node $node)
    {
        if(!$user->hasPermissionTo('edit_annual_node_events')){
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
     * @param  \App\Models\AnnualNodeEvent  $annualNodeEvent
     * @return mixed
     */
    public function delete(User $user, AnnualNodeEvent $annualNodeEvent)
    {
        if(!$user->hasPermissionTo('destroy_annual_node_events')){
            return false;
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
