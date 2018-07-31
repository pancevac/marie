<?php

namespace App\Providers;

use App\Helper;
use App\MenuLink;
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

        view()->composer(env('APP_THEME') .'.partials.header', function($view) use ($menu){
            $view->with('menu', $menu);
        });
        view()->composer(env('APP_THEME') .'.partials.sidenav', function($view) use ($menu){
            $view->with('menu', $menu);
        });
    }
}
