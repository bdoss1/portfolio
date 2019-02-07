<?php

namespace App\Providers;

use App\Services\LocaleService;
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
        $this->app['request']->server->set('HTTPS', env('HTTPS_PROTOCOL', false));
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
