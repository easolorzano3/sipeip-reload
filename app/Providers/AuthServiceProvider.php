<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Permitir acceso total si el usuario tiene el permiso "todo"
      //  Gate::before(function ($user, $ability) {
        //    return $user->hasPermissionTo('ver modulo administración y seguridad') ? true : null;
        //});
    }
}
