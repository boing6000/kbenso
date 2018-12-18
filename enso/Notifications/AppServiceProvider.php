<?php

namespace LaravelEnso\Notifications;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Notifications\app\Commands\AddMissingPermissions;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            AddMissingPermissions::class,
        ]);
        $this->loadDependencies()
            ->publishDependencies();
    }

    public function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        return $this;
    }

    public function publishDependencies()
    {
        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'notifications-assets');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'enso-assets');
    }

    public function register()
    {
        //
    }
}
