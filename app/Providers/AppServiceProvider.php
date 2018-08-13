<?php

namespace Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
           'Laravel\Contracts\UserContract',
           'Laravel\Repositories\UserRepository'
        );
        $this->app->bind(
           'Laravel\Contracts\UserCvContract',
           'Laravel\Repositories\UserCvRepository'
        );
        $this->app->bind(
           'Laravel\Contracts\ProfessionContract',
           'Laravel\Repositories\ProfessionRepository'
        );
    }
}
