<?php
namespace App\Http\Middleware;
use Closure;

class RolDiferenteAlCliente {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
      // Verifica el rol el usuaro logeado que no sea cliente
      if ($request->user()->hasRole(config('app.rol_cliente'))) {
        return abort(403);
      }
      return $next($request);
    }
}
