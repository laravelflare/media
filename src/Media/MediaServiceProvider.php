<?php

namespace LaravelFlare\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        // Assets
        $this->publishes([
            __DIR__.'/../public/jquery-file-upload' => public_path('vendor/flare/jquery-file-upload'),
            __DIR__.'/../public/js' => public_path('vendor/flare/js'),
        ], 'public');

        // Config
        $this->publishes([
            __DIR__.'/../config/flare/media.php' => config_path('flare-config/media.php'),
        ]);

        // Migrations
        $this->publishes([
            __DIR__.'/Database/Migrations' => base_path('database/migrations'),
        ]);

        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'flare');
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/flare'),
        ]);

        $this->registerBladeOperators();
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->registerServiceProviders();
    }

    /**
     * Register Service Providers.
     */
    protected function registerServiceProviders()
    {
    }

    /**
     * Register Blade Operators.
     */
    protected function registerBladeOperators()
    {
    }
}
