<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Auth;
use ILluminate\Auth\AuthenticationException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception) {
        if ($request->expectsJson()) {
            session()->put('url.intended', $request->fullUrl());
            
            if ($request->is('admin') || $request->is('admin/*')) {
                return response(route('admin.login.show'), 401);
            } elseif ($request->is('staff') || $request->is('staff/*')) {
                return response(route('staff.login.show'), 401);
            } else {
                return response(route('client.login.show'), 401);
            }
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->route('admin.login.show');
        } elseif ($request->is('staff') || $request->is('staff/*')) {
            return redirect()->route('staff.login.show');
        } else {
            return redirect()->route('home');
        }
    }
}
