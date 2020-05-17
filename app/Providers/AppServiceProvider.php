<?php

namespace App\Providers;

use App\Container\TestServiceContainer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TestServiceContainer::class,function($app){
            return new TestServiceContainer('ure');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //added for fix problem in original framework
        Schema::defaultStringLength(191);
    }
}
