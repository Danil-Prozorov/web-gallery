<?php

namespace App\Providers;

use App\Services\LikeService;
use Illuminate\Support\ServiceProvider;

class likeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Interfaces\LikeInterface', function($app) {
           return new LikeService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
