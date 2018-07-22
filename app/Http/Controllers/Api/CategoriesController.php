<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
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
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request){
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
            'category' => $category->load('parentCategory'),
            'categories' => Category::select('id', 'title')->where(['parent' => 0, 'is_visible' => 1])->where('id', '<>', $category->id)->get(),
        ]);
    }


    /**
     * method used to update blog and return
     *
     * @param CreateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateCategoryRequest $request, Category $category){
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

    /**
     * method used to return list of categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $parent = request('parent')?: false;
        $categories = Category::where(function ($query) use ($parent){
                if($parent){
                    $query->where('parent', 0);
                }
            })->visible()->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'categories' => $categories,
            'lists' => $categories->pluck('title', 'id'),
        ]);
    }

    /**
     * method used to return tree of categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort(){
        $categories = Category::tree();

        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function saveOrder(){
        Category::orderCategories(request('categories'), 0);

        $categories = Category::tree();

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
