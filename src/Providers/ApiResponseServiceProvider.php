<?php

namespace MizterFrek\LaravelApiResponser\Providers;

use Illuminate\Support\ServiceProvider;
use MizterFrek\LaravelApiResponser\ApiResponse;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected function registerFacades(): void
    {
        $this->app->bind('mizterfrek.api-response', fn() => new ApiResponse);
    }
}
