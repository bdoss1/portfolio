<?php

namespace App\Providers;

use App\Services\LocaleService;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LocaleService::SERVICE_NAME, function () {
            return app()->make(LocaleService::class);
        });
    }
}
