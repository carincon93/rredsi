<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
       /** 'academic-programs*',
        'academic-works*',
        'educational-environments*',
        'educational-institutions*',
        'educational-tools*',
        'events*',
        'graduations*',
        'knowledge-areas*',
        'loans*',
        'nodes*',
        'projects*',
        'researchers*',
        'research-groups*',
        'research-lines*',
        'research-outputs*',
        'research-teams*',
        'students*',
        'users*',
        'research-team-admins*',
        'educational-institution-admins*',
        'register-event*'
         */
    ];
}
