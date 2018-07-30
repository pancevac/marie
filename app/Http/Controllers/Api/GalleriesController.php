<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class GalleriesController extends Controller
{
    /**
     * method used to return post with gallery images
     *
     * @param int $post_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($post_id){
        return response()->json([
            'post' => Post::find($post_id)->load('gallery'),
        ]);
    }

    /**
     * method used to store gallery images related to post model
     *
     * @param int $post_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($post_id, Request $request){
        $post = Post::find($post_id);
        $post->storeGallery();

        return response()->json([
            'post' => $post,
        ]);
    }

    /**
     * method used to remove gallery image
     *
     * @param int $gallery_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy($gallery_id){
        $gallery = Gallery::find($gallery_id);
        $gallery->delete();

        return response([
            'message' => 'deleted'
        ], 200);
    }

    public function serialize($post_id, Request $request){
        if(!empty(request('gallery'))){
            foreach (request('gallery') as $gallery){
                $image = Gallery::find($gallery['id']);
                $image->update(['title' => $gallery['title'], 'desc' => $gallery['desc']]);
            }
        }

        return response([
            'post' => Post::find($post_id)->load('gallery'),
        ], 200);
    }
}
