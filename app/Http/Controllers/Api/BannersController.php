<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Http\Requests\CreateBannerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banners = Banner::orderBy('id', 'DESC')->paginate(50);

        return response()->json([
            'banners' => $banners,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request){
        $banner = Banner::create(request()->except('image'));
        $banner->update(['image' => $banner->storeImage()]);

        return response([
            'banner' => $banner,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner){
        return response([
            'banner' => $banner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBannerRequest $request, Banner $banner){
        $banner->update(request()->except('image'));
        $banner->update(['image' => $banner->storeImage()]);

        return response([
            'banner' => $banner,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner){
        $banner->delete();

        return response([
            'message' => 'Banner je obrisan.'
        ]);
    }
}
