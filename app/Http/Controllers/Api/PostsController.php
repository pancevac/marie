<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Helper;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use App\Traits\SearchableTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PostsController extends Controller
{
    /**
     * method used to search post paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        return response()->json([
            'posts' => Post::search(),
            'blogs' => Blog::getNoParentBlogList(),
        ]);
    }

    /**
     * method used to show posts paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $posts = Post::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'posts' => $posts,
            'blogs' => Blog::getNoParentBlogList(),
        ]);
    }


    /**
     * method used to store new post and return
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePostRequest $request){
        $post = Post::create($request->except('image'));
        $post->update(['image' => $post->storeImage()]);
        $post->blog()->sync(explode(',', request('blog_ids')));

        return response()->json([
            'post' => $post,
        ]);
    }

    /**
     * method used to return post
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post){
        return response()->json([
            'post' => $post,
            'blog_ids' => $post->blog()->pluck('id'),
        ]);
    }

    /**
     * method used to update post and return
     *
     * @param CreatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreatePostRequest $request, Post $post){
        $post->update($request->except('image'));
        $post->update(['image' => $post->storeImage()]);
        $post->blog()->sync(explode(',', request('blog_ids')));

        return response()->json([
            'post' => $post,
            'blog_ids' => $post->blog()->pluck('id'),
        ]);
    }

    /**
     * method used to destroy post
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Post $post){
        if(!empty($post->image)) File::delete($post->image);
        $post->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
