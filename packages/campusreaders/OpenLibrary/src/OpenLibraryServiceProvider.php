<?php

namespace CampusReaders\OpenLibrary;

use Illuminate\Support\ServiceProvider;

class OpenLibraryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('openlibrary', function () {
            return new OpenLibrary();
        });
    }

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // Publish config
        $this->publishes([
            __DIR__ . '/../config/openlibrary.php' => config_path('openlibrary.php'),
        ], 'config');
    }
}
