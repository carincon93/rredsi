<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (QueryException $e, $request) {
            switch ($e->getCode()) {
                case '23503':
                    return back()->with('status', 'Error');
                    break;
                case '23505':
                    return abort(500, $e->getMessage());
                    break;
                case '08006':
                    return view('errors.timeout');
                    break;
                case '22P02':
                    abort(404);
                    break;
                // case '7':
                //     abort(500);
                default:
                    break;
            }
        });
    }
}
