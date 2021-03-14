<?php

namespace App\Policies;

use App\Models\EducationalInstitutionFaculty;
use App\Models\EducationalInstitution;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationalInstitutionFacultyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, EducationalInstitution $educationalInstitution)
    {
        if(!$user->hasPermissionTo('index_educational_institution_faculty')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionFaculty  $educationalInstitutionFaculty
     * @return mixed
     */
    public function view(User $user, EducationalInstitution $educationalInstitution)
    {
        if(!$user->hasPermissionTo('show_educational_institution_faculty')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
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
    public function create(User $user,EducationalInstitution $educationalInstitution)
    {
        if(!$user->hasPermissionTo('create_educational_institution_faculty')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionFaculty  $educationalInstitutionFaculty
     * @return mixed
     */
    public function update(User $user, EducationalInstitution $educationalInstitution)
    {
        if(!$user->hasPermissionTo('edit_educational_institution_faculty')){
            return false;
        }

       $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionFaculty  $educationalInstitutionFaculty
     * @return mixed
     */
    public function delete(User $user, EducationalInstitution $educationalInstitution)
    {
        if(!$user->hasPermissionTo('destroy_educational_institution_faculty')){
            return false;
        }

        $admin = $educationalInstitution->administrator->id;
        if($admin == $user->id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionFaculty  $educationalInstitutionFaculty
     * @return mixed
     */
    public function restore(User $user, EducationalInstitutionFaculty $educationalInstitutionFaculty)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EducationalInstitutionFaculty  $educationalInstitutionFaculty
     * @return mixed
     */
    public function forceDelete(User $user, EducationalInstitutionFaculty $educationalInstitutionFaculty)
    {
        //
    }
}
