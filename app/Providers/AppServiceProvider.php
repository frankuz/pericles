<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channels\ExternalEmailChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('external-email', function ($app) {
                return $app->make(ExternalEmailChannel::class);
            });
        });
    }

}
