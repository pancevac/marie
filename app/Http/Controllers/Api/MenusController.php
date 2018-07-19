<?php

namespace App\Http\Controllers\Api;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    /**
     * Display a listing of Menu model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $menus = Menu::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'menus' => $menus,
        ]);
    }

    /**
     * store a newly created Menu model
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $menu = Menu::create(request()->all());

        return response()->json([
            'menu' => $menu,
        ]);
    }

    /**
     * Display the specified Menu model
     *
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Menu $menu){

        return response()->json([
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified Menu model
     *
     * @param Request $request
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Menu $menu){
        $menu->update(request()->all());

        return response()->json([
            'menu' => $menu,
        ]);
    }

    /**
     * Remove the specified Menu model
     *
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Menu $menu){
        $menu->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
