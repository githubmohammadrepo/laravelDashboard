<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Select;
use App\View\Components\AlertSuccess;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use App\Container\TestServiceContainer;
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

        // reister slots 
        Blade::component('success', Select::class);

        Blade::component('package-alert', Alert::class);

    }
}
