<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Nullable;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {

        // ? valido si existe hoja de vida o no para validar el request
        if ($user->cv == $input['cv']) {
            Validator::make($input, [
                'name'              => ['required', 'string', 'max:255'],
                'email'             => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'cellphone_number'  => ['required', 'integer','min:0' ,'max:9999999999'],
                'biography'         => ['required'],
                'cvlac'             => ['required', 'url',  'max:191'],
                // 'cv'                => ['nullable', 'file','mimetypes:application/pdf','max:512000'],
                'photo'             => ['nullable', 'image','max:1024'],
            ])->validateWithBag('updateProfileInformation');

        }else{

            Validator::make($input, [
                'name'              => ['required', 'string', 'max:255'],
                'email'             => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'cellphone_number'  => ['required', 'integer','min:0' ,'max:9999999999'],
                'biography'         => ['required'],
                'cvlac'             => ['required', 'url',  'max:191'],
                'cv'                => ['max:20000','file','mimetypes:application/pdf'],
                'photo'             => ['nullable', 'image','max:1024'],
            ])->validateWithBag('updateProfileInformation');

        }


        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }


        if ($user->cv == $input['cv']) {
            $input['cv']  = $user->cv;
        }else{

            if (isset($input['cv'])) {
                Storage::delete("public/$user->cv");
                $file       = $input['cv'];
                $extension  = $file->extension();
                $fileName   = Str::slug(substr($user->name, 0, 20))."-cv.$extension";
                Storage::putFileAs(
                    'public/users', $file, $fileName
                );
                $input['cv']  = "users/$fileName";
            }else{
                $input['cv']  = $user->cv;
            }

        }



        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name'              => $input['name'],
                'email'             => $input['email'],
                'cellphone_number'  => $input['cellphone_number'],
                'biography'         => $input['biography'],
                'cvlac'             => $input['cvlac'],
                'cv'                => $input['cv'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'cellphone_number'  => $input['cellphone_number'],
            'biography'         => $input['biography'],
            'cvlac'             => $input['cvlac'],
            'cv'                => $input['cv'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
