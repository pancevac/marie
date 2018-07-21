<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CreateCategoriesRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * method used to show categories paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $categories = Category::with('parentCategory')->orderBy('created_at', 'DESC')->paginate(Product::$paginate);

        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
     * method used to store new category and return
     *
     * @param CreateCategoriesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoriesRequest $request){
        $category = Category::create($request->except('image'));
        $category->update(['image' => $category->storeImage()]);

        return response()->json([
            'category' => $category,
        ]);
    }


    /**
     * method used to return category
     *
     * @param Category $blog
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category){
        return response()->json([
            'blog' => $category->load('parenCategory'),
            'lists' => Category::select('id', 'title')->where(['parent' => 0, 'is_visible' => 1])->where('id', '<>', $category->id)->get(),
        ]);
    }


    /**
     * method used to update blog and return
     *
     * @param CreateCategoriesRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateCategoriesRequest $request, Category $category){
        $category->update($request->except('image'));
        $category->update(['image' => $category->storeImage()]);

        return response()->json([
            'category' => $category,
        ]);
    }


    /**
     * method used to destroy category
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category){
        $category->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * method used to return tree of categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(){
        return response()->json([
            'categories' => Category::tree(),
        ]);
    }
}
