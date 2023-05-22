<?php

namespace Locomotif\Clients;

use Illuminate\Support\ServiceProvider;

class ClientsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Locomotif\Clients\Controller\ClientsController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'clients');

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/locomotif/clients'),
        ]);
        
    }
}
