<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Http\Requests\CreateBannerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    /**
     * Display a listing of Banner model
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
     * method used to store a newly created Banner model
     *
     * @param  CreateBannerRequest  $request
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
     * method used to display the specified Banner model
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
     * method used to update the specified Banner model
     *
     * @param  CreateBannerRequest  $request
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
     * method ised to remove the specified Banner model
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
