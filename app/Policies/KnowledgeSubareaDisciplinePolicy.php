<?php

namespace App\Policies;

use App\Models\KnowledgeSubareaDiscipline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgeSubareaDisciplinePolicy
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
        if($user->hasPermissionTo('index_knowledge_subarea_discipline')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return mixed
     */
    public function view(User $user, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('show_knowledge_subarea_discipline')){
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
        if($user->hasPermissionTo('create_knowledge_subarea_discipline')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return mixed
     */
    public function update(User $user, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('edit_knowledge_subarea_discipline')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return mixed
     */
    public function delete(User $user, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        if($user->hasRole('Admin')){
            return true;
        }
        if($user->hasPermissionTo('destroy_knowledge_subarea_discipline')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return mixed
     */
    public function restore(User $user, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KnowledgeSubareaDiscipline  $knowledgeSubareaDiscipline
     * @return mixed
     */
    public function forceDelete(User $user, KnowledgeSubareaDiscipline $knowledgeSubareaDiscipline)
    {
        //
    }
}
