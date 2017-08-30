<?php

namespace Samarete\Http\Middleware;

use Closure;

use Samarete\Repositories\UserRepository;

class IsAdmin
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
        if (UserRepository::isAdmin()) {
            return $next($request);
        }

        abort(403, "Insufficient permissions. Administration only!");
    }
}