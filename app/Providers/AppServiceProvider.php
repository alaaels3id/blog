<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Request;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        // Root of the website
        view()->share('root', Request::root());

        // authentication user
        view()->composer('*', function ($view) {
            $view->with('auth', auth()->user());
        });
    }

    public function register()
    {
        //
    }
}
