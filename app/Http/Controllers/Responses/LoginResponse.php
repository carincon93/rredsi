<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        $role = Auth::user()->role;
        dd($role);
        switch ($role) {
            case 'admin':
                return '/admin_dashboard';
                break;
            case 'seller':
                return '/seller_dashboard';
                break;
            default:
                return '/home';
                break;
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}
