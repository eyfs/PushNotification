<?php

namespace Edujugon\PushNotification\Providers;

use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\ServiceProvider;

//  implements DeferrableProvider removed for Laravel 5.5 compatibility
class PushNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $configPath = $this->app->make('path.config');

        $this->publishes([
            __DIR__.'/../Config/config.php' => $configPath.'/pushnotification.php',
            __DIR__.'/../Config/iosCertificates' => $configPath.'/iosCertificates/',
        ], 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('edujugonPushNotification', function ($app) {
            return new PushNotification();
        });

        $this->app->bind(PushNotification::class, 'edujugonPushNotification');
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            PushNotification::class,
            'edujugonPushNotification',
        ];
    }
}
