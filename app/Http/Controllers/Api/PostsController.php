<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Output\ProcOutputPager;

class PostsController extends Controller
{
    /**
     * method used to store new post and return
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePostRequest $request){
        $post = Post::create($request->except('image', 'image_box'));
        $post->update(['image' => $post->storeImage(), 'image_box' => $post->storeImage('image_box', 'image_box')]);
        $post->blog()->sync(explode(',', request('blog_ids')));
        $post->tag()->sync(!empty(request('tag_ids'))? explode(',', request('tag_ids')) : []);

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
            'blogs' => Blog::tree(),
            'tags' => Tag::select('id', 'title')->visible()->get(),
            'post' => $post,
            'blog_ids' => $post->blog()->pluck('id'),
            'tag_ids' => $post->tag()->get(['title', 'id']),
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
        $post->update($request->except('image', 'image_box'));
        $post->update(['image' => $post->storeImage(), 'image_box' => $post->storeImage('image_box', 'image_box')]);
        $post->blog()->sync(explode(',', request('blog_ids')));
        $post->tag()->sync(!empty(request('tag_ids'))? explode(',', request('tag_ids')) : []);

        return response()->json([
            'post' => $post,
            'blog_ids' => $post->blog()->pluck('id'),
            'tag_ids' => $post->tag()->pluck('id'),
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
        $post->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * method used to search post paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        Post::setBlogValue();
        return response()->json([
            'posts' => Post::search()->with('blog')->paginate(Post::$paginate),
        ]);
    }
}
