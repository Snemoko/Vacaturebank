<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Advert;

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
        $ad =Advert::select()->get();

        view()->share(compact('ad'));
    }
}
