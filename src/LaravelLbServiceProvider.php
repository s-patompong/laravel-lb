<?php

namespace LaravelLb;

use Illuminate\Support\ServiceProvider;

class LaravelLbServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/logicboxes.php' => config_path('logicboxes.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('lb_logger', function ($app) {
            return new Logger();
        });
    }
}
