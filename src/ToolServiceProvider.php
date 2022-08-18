<?php
namespace BenLumley\NovaImpersonateFrontend;

use Illuminate\Support\ServiceProvider;

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
                $this->app['Illuminate\Contracts\Http\Kernel']->pushMiddleware(\BenLumkey\NovaImpersonateFrontend\Http\Middleware\Impersonate::class);
            }
            $this->routes();
        });

    }
}
