<?php
namespace BenLumley\NovaImpersonateFrontend;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-impersonate-frontend');

        $this->publishes([
                             __DIR__.'/../resources/views' => base_path('resources/views/vendor/nova-impersonate-frontend'),
                         ], 'nova-impersonate-frontend-views');

        $this->publishes([
                             __DIR__.'/../config/nova-impersonate-frontend.php' => config_path('nova-impersonate-frontend.php'),
                         ], 'nova-impersonate-frontend-config');

        $this->app->booted(function () {
            if (config('nova-impersonate-frontend.enable_middleware')) {
                $this->app['Illuminate\Contracts\Http\Kernel']->pushMiddleware(\BenLumley\NovaImpersonateFrontend\Http\Middleware\Impersonate::class);
            }
            $this->routes();
        });

    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        if (config('nova-impersonate-frontend.enable_routes', true)) {
            Route::prefix('nova-impersonate-frontend')
                 ->name('nova.impersonate-frontend.')
                 ->group(__DIR__.'/../routes/web.php');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-impersonate-frontend.php', 'nova-impersonate-frontend');
    }
}
