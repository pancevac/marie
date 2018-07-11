<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return $posts = Post::with('parenBlog')->get();
        return view('test', compact('blogs'));
    }
}
