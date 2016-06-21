<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RaikServicePeovider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Test Service Provider
        $this->app->singleton('Riak\Contracts\Connection', function ($app) {
            return new Connection(config('riak'));
        });

    }
}
