<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
      $this->app['router']->aliasMiddleware('HR.auth', \App\Http\Middleware\HRMiddleware::class);
    $this->app['router']->aliasMiddleware('admin.auth', \App\Http\Middleware\AdminMiddleware::class);
    $this->app['router']->aliasMiddleware('hrpu.auth', \App\Http\Middleware\HRPUMiddleware::class);
    $this->app['router']->aliasMiddleware('EXT.auth', \App\Http\Middleware\EXTMiddleware::class);
          
    }
}
