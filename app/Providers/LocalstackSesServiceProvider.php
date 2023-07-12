<?php

namespace App\Providers;

use Aws\Ses\SesClient;
use Illuminate\Support\ServiceProvider;

class LocalstackSesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (config('app.env') === 'local') {
            $this->app->bind('ses', function () {
                return new SesClient(config('services.ses'));
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
