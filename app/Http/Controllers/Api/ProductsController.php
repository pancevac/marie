<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * method used to show products paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'products' => $products,
        ]);
    }

    /**
     * method used to store new product and return
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request){
        $product = Product::create(request()->except('image'));
        $product->update(['image' => $product->storeImage()]);

        return response()->json([
            'product' => $product,
        ]);
    }


    /**
     * method used to return product
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product){
        return response()->json([
            'product' => $product,
        ]);
    }


    /**
     * method used to update product and return
     *
     * @param CreateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateProductRequest $request, Product $product){
        $product->update(request()->except('image'));
        $product->update(['image' => $product->storeImage()]);

        return response()->json([
            'product' => $product,
        ]);
    }


    /**
     * method used to destroy product
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product){
        $product->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * Posts search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request){
        $category = request('category');
        $text = request('text');

        $products = Product::select('products.*')->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where(function($query) use ($category){
                if($category > 0){
                    $query->where('categories.id', $category);
                }
            })
            ->where(function ($query) use ($text){
                if(!empty($text)){
                    $query->where('products.title', 'like', '%'.$text.'%')->orWhere('products.slug', 'like', '%'.$text.'%')
                        ->orWhere('products.id', 'like', '%'.$text.'%')->orWhere('products.code', 'like', '%'.$text.'%');
                }
            })->groupBy('products.id')->orderBy('products.id', 'DESC')->paginate(50);

        $products->map(function($product){ $product->edit = false; return $product; } );

        return response()->json([
            'products' => $products
        ]);
    }
}
