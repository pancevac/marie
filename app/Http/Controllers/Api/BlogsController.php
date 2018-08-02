<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Requests\CreateBlogRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    /**
     * method used to show blogs paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $blogs = Blog::with('parentBlog')->orderBy('created_at', 'DESC')->paginate(Blog::$paginate);

        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    /**
     * method used to store new blog and return
     *
     * @param CreateBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBlogRequest $request){
        $blog = Blog::create($request->except('image'));
        $blog->update(['image' => $blog->storeImage()]);

        return response()->json([
            'blog' => $blog,
        ]);
    }


    /**
     * method used to return blog
     *
     * @param Blog $blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Blog $blog){
        return response()->json([
            'blog' => $blog->load('parentBlog'),
            'lists' => Blog::select('id', 'title')->where(['parent' => 0, 'is_visible' => 1])->where('id', '<>', $blog->id)->get(),
        ]);
    }


    /**
     * method used to update blog and return
     *
     * @param CreateBlogRequest $request
     * @param Blog $blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateBlogRequest $request, Blog $blog){
        $blog->update($request->except('image'));
        $blog->update(['image' => $blog->storeImage()]);

        return response()->json([
            'blog' => $blog,
        ]);
    }


    /**
     * method used to destroy blog
     *
     * @param Blog $blog
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Blog $blog){
        $blog->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * method used to return tree of blogs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(){
        return response()->json([
            'blogs' => Blog::tree(),
        ]);
    }

    /**
     * method used to return list of blogs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $parent = request('parent')?: false;
        $blogs = Blog::where(function ($query) use ($parent){
            if($parent){
                $query->where('parent', 0);
            }
        })->visible()->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'blogs' => $blogs,
            'lists' => $blogs->pluck('title', 'id')->prepend('Izberi kategoriju', 0),
        ]);
    }
}
