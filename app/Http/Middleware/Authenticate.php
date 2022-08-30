<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Throwable;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {   
        if (! $request->expectsJson()) {
            try{
                // dd(route('login'));
                return route('login');
            }catch(Throwable $e){
                dd($e);
            }
        }
    }
}
