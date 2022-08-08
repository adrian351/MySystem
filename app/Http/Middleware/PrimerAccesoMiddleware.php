<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
// Otros
use Illuminate\Support\Facades\Cache;

class PrimerAccesoMiddleware {
    public function handle($request, Closure $next) {
      // Registra la fecha de primer acceso al sistema
      if(Auth::user()->email_verified_at == null) {
        Auth::user()->update(['email_verified_at' => now()]);
        Cache::tags(['usuario.index', 'cliente.index'])->flush(); // Elimina la cache con el tag espesificado
      }
      return $next($request); 
    }
}