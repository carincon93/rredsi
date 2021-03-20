<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        // ? desactivamos el usuario para no eliminarlo mandamos el status por una session  y actualizamos su estado
        $User = Auth::user();

        $User->tokens->each->delete();

        $User->is_enabled = false;

        $User->save();

        session(['status'=> 'El usuario ha sido desactivado.']);
    }
}
