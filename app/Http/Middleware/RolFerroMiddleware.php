<?php
namespace App\Http\Middleware;
use Closure;

class RolFerroMiddleware {
    public function handle($request, Closure $next) {
        if(auth()->user()->hasRole(config('app.rol_ferro'))) {
            return $next($request);
        }
        return abort(401);
    }
}