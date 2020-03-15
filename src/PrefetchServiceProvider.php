<?php

namespace Katsana\Prefetch;

use Illuminate\Console\Application as Artisan;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Orchestra\Canvas\Core\CommandsProvider;

class PrefetchServiceProvider extends ServiceProvider
{
    use CommandsProvider;

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
            $preset = $this->presetForLaravel($this->app);

            Artisan::starting(function ($artisan) use ($preset) {
                $artisan->add(new Console\MakePrefetchCommand($preset));
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
