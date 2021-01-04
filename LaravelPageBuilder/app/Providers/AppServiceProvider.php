<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PHPageBuilder\PHPageBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->app->singleton('phpPageBuilder', function($app) {
        //     return new PHPageBuilder(config('pagebuilder'));
        // });
        // $this->app->make('phpPageBuilder');
    }
}
