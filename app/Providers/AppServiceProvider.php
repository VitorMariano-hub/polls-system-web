<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

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
        if (env('APP_ENV') === 'production') {
            // Força todas as URLs geradas pelo Laravel a usarem HTTPS
            URL::forceScheme('https');
    
            // Configura Laravel para confiar no proxy (como Railway)
            Request::setTrustedProxies(
                ['*'], // Aceita qualquer proxy, útil em plataformas como Railway ou Heroku
                Request::HEADER_X_FORWARDED_ALL
            );
        }
    }
}
