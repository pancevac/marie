<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Requests\CreateBrandRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    /**
     * method used to show brands paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $brands = Brand::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'brands' => $brands,
        ]);
    }

    /**
     * method used to store new brand and return
     *
     * @param CreateBrandRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBrandRequest $request){
        $brand = Brand::create(request()->except('image', 'logo'));
        $brand->update(['image' => $brand->storeImage(), 'logo' => $brand->storeImage('logo', 'logo')]);

        return response()->json([
            'brand' => $brand,
        ]);
    }


    /**
     * method used to return brand
     *
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Brand $brand){
        return response()->json([
            'brand' => $brand,
        ]);
    }


    /**
     * method used to update brand and return
     *
     * @param CreateBrandRequest $request
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateBrandRequest $request, Brand $brand){
        $brand->update(request()->except('image', 'logo'));
        $brand->update(['image' => $brand->storeImage(), 'logo' => $brand->storeImage('logo', 'logo')]);

        return response()->json([
            'brand' => $brand,
        ]);
    }


    /**
     * method used to destroy brand
     *
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Brand $brand){
        $brand->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
