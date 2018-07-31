<?php

namespace App\Http\Controllers;

use App\Post;
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
}
