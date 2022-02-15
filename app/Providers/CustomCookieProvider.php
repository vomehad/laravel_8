<?php

namespace App\Providers;

use App\Services\CustomCookieService;
use Illuminate\Support\ServiceProvider;

class CustomCookieProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CustomCookieService::class, function () {
            return new CustomCookieService();
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
