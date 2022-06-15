<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorRedirectIfAuthenticated
{
    //Step 8: Created DoctorRedirectIfAuthenticated middleware for doctor
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {


        if (Auth::guard('doctor')->check()) {
            if(is_null(Auth::guard('doctor')->user()->name)){
                return redirect()->route('profile.index');
            }
            return redirect()->route('doctor.dashboard');
        }


        return $next($request);
    }
}
