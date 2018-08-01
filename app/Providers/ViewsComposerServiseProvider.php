<?php

namespace App\Providers;

use App\Helper;
use App\MenuLink;
use App\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewsComposerServiseProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerMenuTop();
        $this->composerSettings();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composerMenuTop(){
        $menu = Cache::remember('menu', Helper::getMinutesToTheNextHour(), function (){
            return MenuLink::tree(1);
        });

        view()->composer('themes.' .env('APP_THEME') .'.partials.header', function($view) use ($menu){
            $view->with('menu', $menu);
        });
        view()->composer('themes.' . env('APP_THEME') .'.partials.sidenav', function($view) use ($menu){
            $view->with('menu', $menu);
        });
        view()->composer('themes.' . env('APP_THEME') .'.partials.footer', function($view) use ($menu){
            $view->with('menu', $menu);
        });
    }

    private function composerSettings(){
        $settings = Cache::remember('settings', Helper::getMinutesToTheNextHour(), function (){
            return Setting::first();
        });
        view()->composer('themes.' . env('APP_THEME') .'.*', function($view) use ($settings){
            $view->with('settings', $settings);
        });
    }
}
