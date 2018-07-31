<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $components = 'site.components';

        Blade::component($components.'.article-teaser', 'article_teaser');
        Blade::component($components.'.related-item', 'related_item');
        Blade::component($components.'.image-gallery', 'image_gallery');

        Blade::component($components.'.beautybox.hero', 'beautybox_hero');
        Blade::component($components.'.beautybox.product', 'beautybox_product');
        Blade::component($components.'.beautybox.partner', 'beautybox_partner');

        Blade::component($components.'.shop.product', 'shop_product');
    }
}
