<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
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
        $cookieval = 'en-EN';
        if(Session::get('locale') !== null){
            $cookieval = Session::get('locale');
        }
        App::setLocale($cookieval);
    }
}
