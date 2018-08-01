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
        return view('themes.' . env('APP_THEME') . '.pages.home', compact('slider', 'latest', 'most_views'));
    }

    /**
     * method used to return category page
     *
     * @param string $slug - present category slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug){
        $category = Blog::whereSlug($slug)->first();
        $latest = Post::getLatest($category);
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.category', compact('category', 'latest', 'do_not_miss_it'));
    }

    /**
     * method used to return sub category page
     *
     * @param string $slug1 - present parent category slug
     * @param string $slug2 - present child category slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subCategory($slug1, $slug2){
        $category = Blog::whereSlug($slug2)->first();
        $latest = Post::getLatest($category);
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.category', compact('category', 'latest', 'do_not_miss_it'));
    }

    /**
     * method used to return post page
     *
     * @param string $slug1 - present category slug
     * @param string $slug2 - present post slug
     * @param integer $id - present post id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function post($slug1, $slug2, $id){
        $post = Post::with('blog', 'user', 'gallery')->find($id);
        if(empty($post)) return redirect('/');
        $category = Blog::whereSlug($slug1)->first();
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.article', compact('category', 'latest', 'do_not_miss_it', 'post'));
    }

    /**
     * method used to return sub post page
     *
     * @param string $slug1 - present parent parent category slug
     * @param string $slug2 - present parent child category slug
     * @param string $slug3 - present post slug
     * @param integer $id - present post id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function subPost($slug1, $slug2, $slug3, $id){
        $post = Post::with('blog', 'user', 'gallery')->find($id);
        if(empty($post)) return redirect('/');
        $category = Blog::whereSlug($slug2)->first();
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.gallery', compact('category', 'latest', 'do_not_miss_it', 'post'));
    }

    /**
     * method used to return gallery page
     *
     * @param string $slug1 - present category slug
     * @param string $slug2 - present post slug
     * @param integer $id - present post id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function gallery($slug1, $slug2, $id){
        $post = Post::with('blog', 'user', 'gallery')->find($id);
        if(empty($post)) return redirect('/');
        $category = Blog::whereSlug($slug1)->first();
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.gallery', compact('category', 'latest', 'do_not_miss_it', 'post'));
    }

    /**
     * method used to return sub gallery page
     *
     * @param string $slug1 - present parent parent category slug
     * @param string $slug2 - present parent child category slug
     * @param string $slug3 - present post slug
     * @param integer $id - present post id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function subGallery($slug1, $slug2, $slug3, $id){
        $post = Post::with('blog', 'user', 'gallery')->find($id);
        if(empty($post)) return redirect('/');
        $category = Blog::whereSlug($slug2)->first();
        $do_not_miss_it = Post::getDoNotMissIt($category, 6, 2);
        return view('themes.' . env('APP_THEME') . '.pages.gallery', compact('category', 'latest', 'do_not_miss_it', 'post'));
    }
}
