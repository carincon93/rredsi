<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\ResearchTeam;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;
use App\Notifications\NewUserBusiness;
use Illuminate\Support\Facades\Auth;

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
        if(isset($input['type_business'])){

            Validator::make($input, [
                'name'                      => ['required', 'string', 'max:255'],
                'email'                     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'document_type'             => ['required', 'string', 'max:255'],
                'document_number'           => ['required', 'integer', 'min:0','max:9999999999'],
                'cellphone_number'          => ['required', 'integer', 'min:0','max:9999999999'],
                'nit'                       => ['required', 'string', 'max:255', 'unique:businesses'],
                'name_business'             => ['required', 'string', 'max:255'],
                'address_business'          => ['required', 'string', 'max:255'],
                'email_business'            => ['required', 'string', 'email', 'max:255'],
                'cellphone_number_business' => ['required', 'integer', 'min:0','max:9999999999'],
                'password'  => $this->passwordRules(),
            ])->validate();

        }else{

            Validator::make($input, [
                'name'             => ['required', 'string', 'max:255'],
                'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'document_type'    => ['required', 'string', 'max:255'],
                'document_number'  => ['required', 'integer', 'min:0','max:9999999999'],
                'cellphone_number' => ['required', 'integer', 'min:0','max:9999999999'],
                'password'  => $this->passwordRules(),
            ])->validate();

        }

        $user = new User();
        $user->name               = $input['name'];
        $user->email              = $input['email'];
        $user->password           = Hash::make($input['password']);
        $user->document_type      = $input['document_type'];
        $user->document_number    = $input['document_number'];
        $user->cellphone_number   = $input['cellphone_number'];
        $user->interests          = json_encode($input['interests']);
        $user->is_enabled         = false;
        $user->nit_business       = $input['nit'] ? $input['nit'] : null;

        if(isset($input['type_business'])){
            $user->assignRole(5);

            $business = new Business();
            $business->nit                = $input['nit'];
            $business->name               = $input['name_business'];
            $business->address            = $input['address_business'];
            $business->cellphone_number   = $input['cellphone_number_business'];
            $business->email              = $input['email_business'];
            $business->data_authorization = $input['data_authorization'] ? true : false;

            $business->save();

        }else{

            $user->assignRole(4);

        }

        if($user->save()){

            if(isset($input['type_business'])){

                #asociasion de usuario empresa
                if(!is_null($input['nit'])){
                    $user->business()->associate($input['nit']);
                }

                Notification::send($user, new NewUserBusiness());


            }else{

                $user->educationalInstitutionFaculties()->attach($input['educational_institutions_faculties_id'],['is_principal' => true]);
                $external = false;
                $researchTeam = ResearchTeam::find($input['research_teams_id']);
                // se agrega al semillero de investigación
                $researchTeam->members()->attach([$user->id => ['is_external' => $external,'accepted_at'=> date("Y-m-d H:i:s")]] );
                $faculty = $user->educationalInstitutionFaculties()->where('is_principal', 1)->first();
                $educationalInstitution = $faculty->educationalInstitution;
                $adminInstitution = $educationalInstitution->administrator;

                $type = "Registro nuevo estudiante";
                Notification::send($adminInstitution, new InformationNotification($user,$type));

            }

        }



        return $user;

    }
}
