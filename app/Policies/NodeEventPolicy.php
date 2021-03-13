<?php

namespace App\Policies;

use App\Models\NodeEvent;
use App\Models\User;
use App\Models\Node;
use Illuminate\Auth\Access\HandlesAuthorization;

class NodeEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user,Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('index_node_event')){
            return false;
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
     * @param  \App\Models\NodeEvent  $nodeEvent
     * @return mixed
     */
    public function view(User $user,Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('show_node_event')){
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
    public function create(User $user,Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('create_node_event')){
            return false;
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
     * @param  \App\Models\NodeEvent  $nodeEvent
     * @return mixed
     */
    public function update(User $user,Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('edit_node_event')){
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
     * @param  \App\Models\NodeEvent  $nodeEvent
     * @return mixed
     */
    public function delete(User $user,Node $node)
    {
        if($user->hasRole(1)){
            return true;
        }
        if(!$user->hasPermissionTo('destroy_node_event')){
            return false;
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
     * @param  \App\Models\NodeEvent  $nodeEvent
     * @return mixed
     */
    public function restore(User $user, NodeEvent $nodeEvent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NodeEvent  $nodeEvent
     * @return mixed
     */
    public function forceDelete(User $user, NodeEvent $nodeEvent)
    {
        //
    }
}
