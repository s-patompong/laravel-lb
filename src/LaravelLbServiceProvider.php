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
            __DIR__.'../config/logicboxes.php' => config_path('logicboxes.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('LaravelLb\LogicBoxes', function ($app) {
            $testMode = config('logicboxes.test_mode');
            $userId = config('logicboxes.auth_userid');
            $apiKey = config('logicboxes.api_key');
            return new LogicBoxes($userId, $apiKey, $testMode);
        });
    }
}
