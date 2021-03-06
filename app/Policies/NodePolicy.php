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
    public function viewAny(User $user,Node $node)
    {

        if(!$user->hasPermissionTo('index_node')){
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
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function view(User $user,Node $node)
    {
        if(!$user->hasPermissionTo('show_node')){
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
        if(!$user->hasPermissionTo('create_node')){
            return false;
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
        if($user->hasPermissionTo('edit_node')){
            return true;
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
     * @param  \App\Models\Node  $node
     * @return mixed
     */
    public function delete(User $user)
    {
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
