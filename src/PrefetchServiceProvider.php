<?php

namespace Katsana\Prefetch;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

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
        $this->registerRouterMacro();
    }

    /**
     * Register router macro.
     *
     * @return void
     */
    protected function registerRouterMacro(): void
    {
        Router::macro('prefetch', function ($uri, $handler) {
            return $this->match(['GET', 'HEAD'], $uri, '\Katsana\Prefetch\Controller')
                ->defaults('handler', $handler);
        });
    }
}
