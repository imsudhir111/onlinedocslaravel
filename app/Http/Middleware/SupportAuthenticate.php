<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SupportAuthenticate extends Middleware
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
            return route('support.login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('support')->check()) {
            return $this->auth->shouldUse('support');
        }

        $this->unauthenticated($request, ['support']);
    }
}
