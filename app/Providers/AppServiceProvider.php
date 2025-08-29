<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

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
        // Forzar HTTPS y confiar en proxies en producción (DigitalOcean App Platform)
        if (app()->environment('production')) {
            try {
                // Confiar en todos los proxies para que Laravel detecte X-Forwarded-* (esquema https)
                Request::setTrustedProxies(['*'], Request::HEADER_X_FORWARDED_ALL);
                URL::forceScheme('https');
                // Ajustar dominio de sesión si no está definido
                if (config('session.domain') === null) {
                    $host = parse_url(config('app.url'), PHP_URL_HOST);
                    if ($host) {
                        config(['session.domain' => $host]);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Fallo configurando proxies/https', ['error' => $e->getMessage()]);
            }
        }
    }
}
