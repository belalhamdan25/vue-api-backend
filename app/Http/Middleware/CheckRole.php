<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( auth('web')->user()->role_name == "freelancer" || auth('web')->user()->role_name == "client") {
            auth('web')->logout();
            return redirect('/login');
        }
        return $next($request);

    }
}
