<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RecaptchaV3Service;
use App\Services\SendGridService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RecaptchaV3Service::class, function ($app) {
            return new RecaptchaV3Service();
        });

        $this->app->singleton(SendGridService::class, function ($app) {
            return new SendGridService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
