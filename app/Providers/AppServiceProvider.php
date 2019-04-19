<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
     * Fires everytime app gets called by a user
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Everytime a view is composed 
        // * means valid for all views
        // for all the views inject usermenu variable from $userMenu
        view()->composer('*', function($view){
            // Generate a user menu
            $userMenu = app('App\Http\Controllers\MenuController')->getUserMenu();
            $view->with('usermenu', $userMenu);
        });
        
        view()->composer('*', function($view){
            // Generate a favourites widget
            $favourites = app('App\Http\Controllers\FavouriteController')->getFavouritesWidget();
            $view->with('favouritesWidget', $favourites);
        });
    }
}
