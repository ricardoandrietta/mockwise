<?php

namespace App\Providers;

use App\Http\Middleware\ApiAnalyticsMiddleware;
use Illuminate\Support\ServiceProvider;

class ApiAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $router = $this->app['router'];

        // Register the middleware with the router
        $router->aliasMiddleware('api-analytics', ApiAnalyticsMiddleware::class);
//
//        // Automatically apply to all API routes
//        $this->router->middlewareGroup('api', [
//            // Other middleware might already be here
//            'api-analytics',
//        ]);
    }
}
