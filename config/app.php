<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Información del desarrollador "Firma"
    |--------------------------------------------------------------------------
    |
    */

    'developer'             => env('APP_DEVELOPER'),
    'developer_url'         => env('APP_DEVELOPER_URL'),
    'version_del_sistema'   => env('APP_VERSION_DEL_SISTEMA'),
    
    /*
    |--------------------------------------------------------------------------
    | Variables del sistema
    |--------------------------------------------------------------------------
    |
    */

    'rol_desarrollador'         => env('ROL_DESARROLLADOR'),
    'rol_sin_acceso_al_sistema' => env('ROL_SIN_ACCESO_AL_SISTEMA'),
    'rol_cliente' => env('ROL_CLIENTE'),
    'rol_ferro' => env('ROL_FERRO'),

    
    'tiempo_max_de_cache_minutos' => env('TIEMPO_MAX_DE_CACHE_MINUTOS'),
    'tiempo_med_de_cache_minutos' => env('TIEMPO_MED_DE_CACHE_MINUTOS'),
    'tiempo_min_de_cache_minutos' => env('TIEMPO_MIN_DE_CACHE_MINUTOS'),

    'longitud_del_password' => env('LONGITUD_DEL_PASSWORD'),

    # =====================  [ MÓDULOS ] =====================
    # --- COLORES
    'color_card_primario'   => 'card-primary',
    'color_bg_primario'     => 'bg-primary',
    'color_card_secundario' => 'card-secondary',
    'color_bg_secundario'   => 'bg-secondary',
    'color_card_terciario'  => 'card-info',
    'color_bg_terciario'    => 'bg-info',
    'color_card_danger'     => 'card-danger',
    'color_bg_danger'       => 'bg-danger',
    'color_card_warning'    => 'card-warning',
    'color_bg_warning'      => 'bg-warning',
    'color_card_dark'       => 'card-dark',
    'color_bg_dark'         => 'bg-dark',

    'color_null' => '', // Sin color
    'color_0' => '#FFF', // White
    'color_a' => '#6C757D', // Dark grayish blue - Debe ir con letra color blanco
    'color_b' => '#bfcde6', // Light grayish blue
    'color_c' => '#A2231B', // Dark red - Debe ir con letra color blanco
    'color_d' => '#28A745', // Dark lime green.
    'color_e' => '#FAAC58', // Soft orange
    'color_f' => '#FFC107', // Vivid yellow
    'color_g' => '#58ACFA', // Soft blue
    'color_h' => '#CEF6CE', // Light grayish lime green.
    'color_i' => '#58FAAC', // Soft cyan - lime green
    'color_j' => '#FA5882', // Soft pink
    'color_k' => '#ACFA58', // Soft green
    'color_l' => '#A9D0F5', // 
    'color_m' => '#FFFF00', // Yellow
    'color_n' => '#E6E6E6', // 
    'color_o' => '#', // 
    'color_p' => '#14C38E',
    'color_q' => '#FF1700',
    
    # ===================== VENTAS [ PEDIDOS ACTIVOS ] =====================
    # --- ESTATUS COTIZACIONES
    'abierta'   => 'Abierta',
    'aprobada'  => 'Aprobada',
    'cancelada' => 'Cancelada',

    # --- ESTATUS GLOBAL
    'pendiente'                 => 'Pendiente',
    'cancelado'                 => 'Cancelado',

    # --- ESTATUS ARMADO
    'productos_completos'   => 'Productos completos',
    'en_almacen_de_salida'  => 'En almacén de salida',
    
    # --- ESTATUS FACTURA
    'no_solicitada'         => 'No solicitada',
    'error_del_cliente'     => 'Error del cliente',
    'facturado'             => 'Facturado',
    'facturado_por_fuera'   => 'Facturado por fuera',
    'facturado_eliminado'   => 'Facturado / Eliminado',  
    
    # --- ESTATUS PAGO
    'pago_pendiente_de_aprobar'     => 'Pago pendiente de aprobar',
    'pago_rechazado'                => 'Pago rechazado',
    'pagado'                        => 'Pagado',
    'pagado_eliminados'             => 'Pagado / Eliminados',
    'pagoseliminados'               => 'Pagos eliminados',

    # --- ESTATUS VENTAS
    'informacion_general_completa'      => 'Información general completa',
    'falta_informacion_general'         => 'Falta Información general',
    'armados_cargados'                  => 'Armados cargados',
    'falta_cargar_armados'              => 'Falta cargar armado(s)',
    'direccion_de_armados_asignado'     => 'Dirección de armados asignado',
    'falta_asignar_direcciones_armados' => 'Falta asignar dirección(es) armado(s)',
    
    # --- ESTATUS VENTAS (DIRECCIONES)
    'direcciones_detalladas'    => 'Direcciones detalladas',
    'falta_detallar_direccion'  => 'Falta detallar dirección',

    # --- ESTATUS ALMACÉN
    'asignar_persona_que_recibe'                => 'Asignar persona que recibe',
    'en_espera_de_ventas'                       => 'En espera de ventas',
    'en_espera_de_compra'                       => 'En espera de compra',
    'en_revision_de_productos'                  => 'En revisión de productos',
    'productos_completos_terminado'             => 'Productos completos terminado',

    # --- ESTATUS PRODUCCIÓN
    'asignar_lider_de_pedido'               => 'Asignar líder de pedido',
    'en_espera_de_almacen'                  => 'En espera de almacén',
    'en_produccion'                         => 'En producción',
    'en_almacen_de_salida_terminado'        => 'En almacén de salida terminado',
    
    # --- ESTATUS LOGÍSTICA
    'en_espera_de_produccion'               => 'En espera de producción',
    'en_ruta'                               => 'En ruta',
    'entregado'                             => 'Entregado',
    'sin_entrega_por_falta_de_informacion'  => 'Sin entrega por falta de información',
    'intento_de_entrega_fallido'            => 'Intento de entrega fallido',

    #========= ESTATUS DE LA NOTA DE REMISION
    /*default
        Sin confirmar
    */
    'sin_confirmar'         => 'Sin confirmar',
    'falta_producto'      => 'Falta producto',
    'confirmada'            => 'Confirmada',

    # ===================== [ PAGOS ] =====================
    'aprobado'  => 'Aprobado',
    'rechazado' => 'Rechazado',
    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'America/Mexico_City',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
/* ===================== [ SISTEMA ] ===================== */
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Laraveles\Spanish\SpanishServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Yoeunes\Toastr\ToastrServiceProvider::class,
        Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'           => Illuminate\Support\Facades\App::class,
        'Arr'           => Illuminate\Support\Arr::class,
        'Artisan'       => Illuminate\Support\Facades\Artisan::class,
        'Auth'          => Illuminate\Support\Facades\Auth::class,
        'Blade'         => Illuminate\Support\Facades\Blade::class,
        'Broadcast'     => Illuminate\Support\Facades\Broadcast::class,
        'Bus'           => Illuminate\Support\Facades\Bus::class,
        'Cache'         => Illuminate\Support\Facades\Cache::class,
        'Config'        => Illuminate\Support\Facades\Config::class,
        'Cookie'        => Illuminate\Support\Facades\Cookie::class,
        'Crypt'         => Illuminate\Support\Facades\Crypt::class,
        'DB'            => Illuminate\Support\Facades\DB::class,
        'Eloquent'      => Illuminate\Database\Eloquent\Model::class,
        'Event'         => Illuminate\Support\Facades\Event::class,
        'File'          => Illuminate\Support\Facades\File::class,
        'Gate'          => Illuminate\Support\Facades\Gate::class,
        'Hash'          => Illuminate\Support\Facades\Hash::class,
        'Lang'          => Illuminate\Support\Facades\Lang::class,
        'Log'           => Illuminate\Support\Facades\Log::class,
        'Mail'          => Illuminate\Support\Facades\Mail::class,
        'Notification'  => Illuminate\Support\Facades\Notification::class,
        'Password'      => Illuminate\Support\Facades\Password::class,
        'Queue'         => Illuminate\Support\Facades\Queue::class,
        'Redirect'      => Illuminate\Support\Facades\Redirect::class,
        'Redis'         => Illuminate\Support\Facades\Redis::class,
        'Request'       => Illuminate\Support\Facades\Request::class,
        'Response'      => Illuminate\Support\Facades\Response::class,
        'Route'         => Illuminate\Support\Facades\Route::class,
        'Schema'        => Illuminate\Support\Facades\Schema::class,
        'Session'       => Illuminate\Support\Facades\Session::class,
        'Storage'       => Illuminate\Support\Facades\Storage::class,
        'Str'           => Illuminate\Support\Str::class,
        'URL'           => Illuminate\Support\Facades\URL::class,
        'Validator'     => Illuminate\Support\Facades\Validator::class,
        'View'          => Illuminate\Support\Facades\View::class,

        'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,
        'JWTFactory' => 'Tymon\JWTAuth\Facades\JWTFactory',

/* ===================== [ SISTEMA ] ===================== */
        'Debugbar'      => Barryvdh\Debugbar\Facade::class,
        'Sistema'       => \App\Models\Sistema::class,
        'Manual'        => \App\Models\Manual::class,
        'Image' => Intervention\Image\Facades\Image::class
    ],
];
