<?php
namespace App\Http\Middleware;
use Closure;

class NavegadorMiddleware {
  public function handle($request, Closure $next) {
    // Verifica en navegador con el que accede el usuario para permitir o no acceder al sistema
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
		if(strpos($user_agent, 'Trident') !== FALSE) { //Internet Explorer 11
      echo( 'Navegador no permitido, se recomienda usar Google Chrome o Mozilla para una mejor experiencia al navegar.');
      exit(0);
		} else {
			return $next($request);
		}  
  }
}