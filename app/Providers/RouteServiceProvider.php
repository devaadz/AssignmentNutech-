<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and more.
     */
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            // Rute API
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // Rute Web
            Route::middleware('auth')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}
