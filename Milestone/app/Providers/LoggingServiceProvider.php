<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Data\Utility\MyLogger3;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('App\Services\Data\Utility\ILoggerService', function($app)
        {
            return new MyLogger3();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
