<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            $this->mapPluginRoutes();
        });
        $this->registerViews();
    }

    protected function mapPluginRoutes()
    {
        $pluginsPath = base_path('plugins');
        $plugins = File::directories($pluginsPath);

        foreach ($plugins as $plugin) {
            $routeFile = $plugin . '/routes/web.php';

            if (File::exists($routeFile)) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group($routeFile);
            }
        }
    }

    protected function registerViews()
    {
        $pluginsPath = base_path('plugins');
        $plugins = File::directories($pluginsPath);

        foreach ($plugins as $plugin) {
            $viewsPath = $plugin . '/views';

            if (File::isDirectory($viewsPath)) {
                $this->loadViewsFrom($viewsPath, 'plugin');
            }
        }
    }
}
