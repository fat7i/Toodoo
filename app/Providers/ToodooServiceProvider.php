<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ToodooServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // add routes
        require_once base_path('/toodoo/routes/api.php');

        view()->addNamespace('toodoo_views', base_path('toodoo/views'));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('toodoo', function ($app) {});
    }
}
