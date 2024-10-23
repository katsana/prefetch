<?php

namespace Katsana\Prefetch;

use Illuminate\Console\Application as Artisan;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Orchestra\Canvas\Canvas;
use Orchestra\Canvas\Core\CommandsProvider;

class PrefetchServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            
            Artisan::starting(function ($artisan) {
                $artisan->add(new Console\MakePrefetchCommand($this->app['files']));
            });
        }

        $this->registerRouterMacro();
    }

    /**
     * Register router macro.
     */
    protected function registerRouterMacro(): void
    {
        Router::macro('prefetch', function ($uri, $component) {
            return $this->match(['GET', 'HEAD'], $uri, '\Katsana\Prefetch\Controller')
                ->defaults('component', $component);
        });
    }
}
