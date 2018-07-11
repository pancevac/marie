<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PostsController extends Controller
{
    /**
     * method used to show posts paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $posts = Post::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'posts' => $posts,
        ]);
    }


    /**
     *  method used to store new post and return
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePostRequest $request){
        $post = Post::create($request->except('image'));
        $post->update(['image' => $post->storeImage()]);

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
            'blog' => $post,
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

        return response()->json([
            'post' => $post,
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

    /**
     * method used to search posts
     *
     * @param POST list
     * @param POST text
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        $blog = request('list');
        $text = request('text');
        $posts = Post::where(function($query) use ($blog){
            if($blog){
                $query->with(['Blogs' => function($query) use ($blog){
                    $query->where('id', $query);
                }]);
            }
        })->where(function ($query) use ($text){
            if($text != ''){
                $query->where('posts.title', 'like', '%'.$text.'%')->orWhere('posts.slug', 'like', '%'.$text.'%');
            }
        })
        ->orderBy('posts.publish_at', 'DESC')->groupBy('posts.id')->paginate(50);

        return response()->json([
            'posts' => $posts,
        ]);
    }
}
