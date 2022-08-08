<?php
namespace App\Http\Middleware;
use Closure;

class RolClienteMiddleware {
    public function handle($request, Closure $next) {
        if(auth()->user()->hasRole(config('app.rol_cliente'))) {
            return $next($request);
        }
        return abort(401);
    }
}