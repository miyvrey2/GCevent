<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            // if the account is activated, return the login
            if(Auth::user()->active === 1) {
                return redirect('/admin/dashboard');
            }

            // Return the account needs to be activated
            return redirect('/validate');
        }

        return $next($request);
    }
}
