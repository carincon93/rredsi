<?php

namespace App\Policies;

use App\Models\Node;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NodePolicy
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
        if($user->hasPermissionTo('index_node')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function view(User $user, Node $node)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('show_node')){
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
        if($user->hasPermissionTo('create_node')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function update(User $user, Node $node)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('edit_node')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function delete(User $user, Node $node)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if($user->hasPermissionTo('destroy_node')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function restore(User $user, Node $node)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function forceDelete(User $user, Node $node)
    {
        //
    }
}
