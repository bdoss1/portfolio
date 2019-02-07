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
    public function boot(UrlGenerator $url)
    {
        if (env('HTTPS_PROTOCOL', false)) {
            $url->forceScheme('https');
        }
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
