<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
/* ===================== [ SISTEMA ] ===================== */
            \App\Http\Middleware\HttpsProtocol::class,

        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                  => \App\Http\Middleware\Authenticate::class,
        'auth.basic'            => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'              => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers'         => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                   => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                 => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm'      => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'                => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'              => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'              => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
/* ===================== [ SISTEMA ] ===================== */
        'RolDiferenteAlCliente' => \App\Http\Middleware\RolDiferenteAlCliente::class,
        'navegador'             => \App\Http\Middleware\NavegadorMiddleware::class, // Niega el acceso a los navegadores especificados en este archivo
        'headerSeguro'          => \App\Http\Middleware\HeadersSegurosMiddleware::class, // Oculta los header del sistema para mejorar la seguridad
        'idiomaSistema'         => \App\Http\Middleware\IdiomaSistemaMiddleware::class, // Definir el idioma del sistema dependiendo la configuración que tenga el usuario en su perfil
        'primerAcceso'          => \App\Http\Middleware\PrimerAccesoMiddleware::class, // Registra la fecha de primer acceso al sistema
        'sinAccesoAlSistema'    => \App\Http\Middleware\SinAccesoAlSistemaMiddleware::class, // Verifica si tiene o no acceso al sistema
        'role'                  => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission'            => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission'    => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        'rolCliente'            => \App\Http\Middleware\RolClienteMiddleware::class, // Acceso especial a los clientes
        'rolFerro'            => \App\Http\Middleware\RolFerroMiddleware::class, // Acceso especial para ferro
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
