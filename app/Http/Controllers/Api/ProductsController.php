<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    /**
     * method used to store new product and return
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request){
        $product = Product::create(request()->except('image'));
        $product->update(['image' => $product->storeImage()]);

        $product->category()->sync(explode(',', request('category_ids')));

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
            'category_ids' => $product->category()->visible()->pluck('id'),
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

        $product->category()->sync(explode(',', request('category_ids')));

        return response()->json([
            'product' => $product,
            'category_ids' => $product->category()->visible()->pluck('id'),
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
     * method used to search and return products
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        Product::setCategoryValue();
        $products = Product::search()->with('brand')->paginate(Product::$paginate);

        return response()->json([
            'products' => $products,
        ]);
    }
}
