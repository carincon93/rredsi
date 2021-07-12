<?php

namespace App\Policies;

use App\Models\BusinessIdeas;
use App\Models\User;


use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
     * @param  \App\Models\Product  $Product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        $business = $user->business()->first();
        if($product->authors($product->id,$business->id) && $user->hasPermissionTo('edit_product')){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        if($user->hasPermissionTo('show_product')){
            return true;
        }
            return false;

    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $Product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        $business = $user->business()->first();
        if($product->authors($product->id,$business->id) && $user->hasPermissionTo('destroy_product')){
            return true;
        }
        return false;
    }

}
