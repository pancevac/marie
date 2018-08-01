<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * method used to return homepage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage(){
        $slider = Post::getSlider();
        $latest = Post::getLatest(false);
        $most_views = Post::getViewed(false);
        return view(env('APP_THEME') . '.pages.home', compact('slider', 'latest', 'most_views'));
    }

    /**
     * method used to return category page
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug){
        $category = Blog::whereSlug($slug)->first();
        $latest = Post::getLatest($category);
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view(env('APP_THEME') . '.pages.category', compact('category', 'latest', 'do_not_miss_it'));
    }
}
