<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentRedirectIfAuthenticated
{
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

        
        // if (Auth::guard('agent')->check()) {
        //     return redirect()->route('agent.dashboard');
        // }
        if (Auth::guard('agent')->check()) {
            if(is_null(Auth::guard('agent')->user()->name)){
                return redirect()->route('agent.login');
            }
            return redirect()->route('agent.dashboard');
        }

        return $next($request);
    }
}
