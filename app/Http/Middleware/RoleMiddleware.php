<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->cargo, $roles)) {
            return $next($request);
        }

        return redirect('/'); // Redirigir si no tiene permiso
    }
}