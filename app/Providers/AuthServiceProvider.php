<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        App\User::class => App\Policies\UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('player-panel', 'App\Policies\UserPolicy@index');
        Gate::define('admin-panel', 'App\Policies\UserPolicy@adminPanel');
        Gate::define('manage-mensalidades', 'App\Policies\UserPolicy@mensalidades');
        Gate::define('manage-perfil', 'App\Policies\UserPolicy@perfil');
        Gate::define('manage-players', 'App\Policies\UserPolicy@players');
        Gate::define('manage-categorias', 'App\Policies\UserPolicy@categorias');
        Gate::define('manage-torneios', 'App\Policies\UserPolicy@torneios');

        //
    }
}
