<?php

namespace App\Policies;

use App\Models\AcademicProgram;
use App\Models\User;
use App\Models\EducationalInstitution;

use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicProgramPolicy
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
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('index_academic_program')){
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
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return mixed
     */
    public function view(User $user, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('show_academic_program')){
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
    public function create(User $user, EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('create_academic_program')){
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
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return mixed
     */
    public function update(User $user,EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('edit_academic_program')){
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
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return mixed
     */
    public function delete(User $user,EducationalInstitution $educationalInstitution)
    {
        if($user->hasRole('Administrador')){
            return true;
        }
        if(!$user->hasPermissionTo('destroy_academic_program')){
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
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return mixed
     */
    public function restore(User $user, AcademicProgram $academicProgram)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AcademicProgram  $academicProgram
     * @return mixed
     */
    public function forceDelete(User $user, AcademicProgram $academicProgram)
    {
        //
    }
}
