<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\EducationalInstitutionFaculty;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => $this->passwordRules(),
        ])->validate();

        $user = new User();
        $user->name               = $input['name'];
        $user->email              = $input['email'];
        $user->password           = Hash::make($input['password']);
        $user->document_type      = $input['document_type'];
        $user->document_number    = $input['document_number'];
        $user->cellphone_number   = $input['cellphone_number'];
        $user->interests          = json_encode($input['interests']);
        $user->is_enabled         = true;
        // $user->assignRole($request->get('role_id'));

        if($user->save()){
            $user->educationalInstitutionFaculties()->attach($input['educational_institutions_faculties_id'],['is_principal' => true]);
            $message = 'Your store processed correctly';
        }


        return $user;
    }
}
