<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;


use Illuminate\Auth\Access\HandlesAuthorization;

class ExperiencePolicy
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
        if($user->hasPermissionTo('index_experience')){
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
    public function create(User $user, Product $product)
    {        
        if($user->hasPermissionTo('create_product')){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Experience  $experience
     * @return mixed
     */
    public function update(User $user, Experience $experience)
    {
        $business = $user->business()->first(); 
        if($experience->authors($experience->id,$business->id) && $user->hasPermissionTo('edit_experience')){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Experience  $experience
     * @return mixed
     */
    public function view(User $user, Experience $experience)
    {
        if($user->hasPermissionTo('show_experience')){            
            return true;
        }
            return false;
        
    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Experience  $Product
     * @return mixed
     */
    public function delete(User $user, Experience $experience)
    {
        $business = $user->business()->first(); 
        if($experience->authors($experience->id,$business->id) && $user->hasPermissionTo('destroy_experience')){
            return true;
        }
        return false;
    }

}
