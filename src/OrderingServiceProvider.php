<?php

namespace Vadiasov\Ordering;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class OrderingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
//        $router->aliasMiddleware('ordering', \Vadiasov\Ordering\Middleware\OrderingMiddleware::class);

//        $this->publishes([__DIR__.'/Config/ordering.php' => config_path('ordering.php'),], 'ordering_config');
//        $this->publishes([__DIR__ . '/Translations' => resource_path('lang/vendor/ordering'),]);
//        $this->publishes([__DIR__ . '/Views' => resource_path('views/vendor/ordering'),]);
//        $this->publishes([__DIR__ . '/Assets' => public_path('vendor/ordering'),], 'ordering_assets');
    
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'ordering');
        $this->loadViewsFrom(__DIR__ . '/Views', 'ordering');
    
//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                \Vadiasov\Ordering\Commands\OrderingCommand::class,
//            ]);
//        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__ . '/Config/ordering.php', 'ordering'
//        );
    }
}
