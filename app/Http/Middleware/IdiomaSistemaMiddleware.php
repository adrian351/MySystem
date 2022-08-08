<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IdiomaSistemaMiddleware {
    public function handle($request, Closure $next) {
      \App::setLocale(Auth::user()->lang); // Definir el idioma del sistema dependiendo la configuración que tenga el usuario en su perfil
      return $next($request);  
    }
}