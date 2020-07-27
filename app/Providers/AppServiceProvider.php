<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Core\Model\SystemConfig;
use Core\Observers\SystemConfigObserver;

use Core\Model\User;
use Core\Observers\UserObserver;

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
        Schema::defaultStringLength(191);
        
        SystemConfig::observe(SystemConfigObserver::class);
        User::observe(UserObserver::class);
    }
}
