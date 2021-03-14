<?php

namespace App\Policies;

use App\Models\KnowledgeSubarea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgeSubareaPolicy
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
        if($user->hasPermissionTo('index_knowledge_subarea')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubarea  $knowledgeSubarea
     * @return mixed
     */
    public function view(User $user)
    {
        if($user->hasPermissionTo('show_knowledge_subarea')){
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
        if($user->hasPermissionTo('create_knowledge_subarea')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubarea  $knowledgeSubarea
     * @return mixed
     */
    public function update(User $user)
    {
        if($user->hasPermissionTo('edit_knowledge_subarea')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubarea  $knowledgeSubarea
     * @return mixed
     */
    public function delete(User $user)
    {
        if($user->hasPermissionTo('destroy_knowledge_subarea')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubarea  $knowledgeSubarea
     * @return mixed
     */
    public function restore(User $user, KnowledgeSubarea $knowledgeSubarea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubarea  $knowledgeSubarea
     * @return mixed
     */
    public function forceDelete(User $user, KnowledgeSubarea $knowledgeSubarea)
    {
        //
    }
}
