<?php

namespace App\Policies;

use App\Models\BusinessIdeas;
use App\Models\User;


use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaPolicy
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
        if($user->hasPermissionTo('index_ideas')){
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
    public function create(User $user, BusinessIdeas $idea)
    {
        if($user->hasPermissionTo('create_idea')){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessIdeas $idea
     * @return mixed
     */
    public function update(User $user, BusinessIdeas $idea)
    {
        $business = $user->business()->first();
        if($idea->authors($idea->id,$business->id) && $user->hasPermissionTo('edit_idea')){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessIdeas $idea
     * @return mixed
     */
    public function view(User $user, BusinessIdeas $idea)
    {
        if($user->hasPermissionTo('show_idea')){
            return true;
        }
            return false;

    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BusinessIdeas $idea
     * @return mixed
     */
    public function delete(User $user, BusinessIdeas $idea)
    {
        $business = $user->business()->first();
        if($idea->authors($idea->id,$business->id) && $user->hasPermissionTo('destroy_idea')){
            return true;
        }
        return false;
    }

}
