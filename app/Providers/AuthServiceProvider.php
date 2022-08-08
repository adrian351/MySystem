<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Otorga implícitamente todos los permisos a la función "Desarrollador"
        // Esto funciona en la aplicación mediante el uso de funciones relacionadas con la puerta como auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('desarrollador') ? true : null;
        });
    }
}