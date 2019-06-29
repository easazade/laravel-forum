<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
//        View::composer('thread.create', function ($view) {
//            $view->with('channels', Channel::all());
//        });

        View::composer('*', function ($view) {
            $view->with('channels', Channel::all());
        });

        //a share method will run before migration in our tests
//        View::share('channels', Channel::all());
    }
}
