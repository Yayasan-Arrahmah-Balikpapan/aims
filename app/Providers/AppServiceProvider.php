<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Contracts\NotificationService::class, \App\Services\WhatsappService::class);
        $this->app->bind(\App\Contracts\LogService::class, \App\Services\LogDMLService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Splade::defaultToast(function ($toast) {
            $toast->info()->rightTop()->autoDismiss(10);
        });

        date_default_timezone_set('Asia/Makassar');
        Carbon::setLocale('id');
    }
}
