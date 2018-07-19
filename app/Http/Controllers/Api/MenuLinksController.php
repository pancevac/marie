<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMenuLinkRequest;
use App\Menu;
use App\MenuLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuLinksController extends Controller
{
    /**
     * method used to display a listing of MenuLink model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $menu = Menu::find(request('id'));
        $menuLinks = $menu->menuLinks()->with('parent_menu')->orderBy('order', 'ASC')->get();
        return response()->json([
            'menu' => $menu,
            'menuLinks' => $menuLinks
        ]);
    }

    /**
     * method used to store a newly created MenuLink model
     *
     * @param CreateMenuLinkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMenuLinkRequest $request){
        $link = MenuLink::create(request()->except('image'));
        $link->update(['image' => $link->storeImage()]);

        return response()->json([
            'link' => $link,
        ]);
    }

    /**
     * method used to display the specified MenuLink model
     *
     * @param MenuLink $menu_link
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(MenuLink $menu_link){
        $links = MenuLink::where('is_visible', 1)->where('parent', 0)->orderBy('order', 'ASC')->get();

        return response()->json([
            'link' => $menu_link,
            'links' => $links,
            'parent' => MenuLink::select('id', 'title')->find($menu_link->parent),
        ]);
    }

    /**
     * method used to update the specified MenuLink model
     *
     * @param CreateMenuLinkRequest $request
     * @param MenuLink $menu_link
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateMenuLinkRequest $request, MenuLink $menu_link){
        $menu_link->update(request()->except('image'));
        $menu_link->update(['image' => $menu_link->storeImage()]);

        return response()->json([
            'link' => $menu_link,
        ]);
    }

    /**
     * method used to remove the specified MenuLink model
     *
     * @param MenuLink $link
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MenuLink $link){
        $link->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * method used to sort the specified MenuLink model
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort($id){
        $menu = Menu::find($id);
        $links = $menu->menuLinks()->select('id', 'title')->with('children')->where('parent', 0)->orderBy('order', 'ASC')->get();

        return response()->json([
            'menu' => $menu,
            'links' => $links,
        ]);
    }

    /**
     * method used to save order of list MenuLink model
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOrder($id){
        $links = request('links');

        MenuLink::orderMenuLinks($links, 0);

        $menu = Menu::find($id);
        $links = $menu->menuLinks()->select('id', 'title')->with('children')->where('parent', 0)->orderBy('order', 'ASC')->get();

        return response()->json([
            'menu' => $menu,
            'links' => $links,
        ]);
    }

    /**
     * method used to return lists of MenuLink model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $links = MenuLink::where('menu_links.is_visible', 1)->where('menu_links.parent', 0)->orderBy('menu_links.order', 'ASC')->get();

        return response()->json([
            'links' => $links,
        ]);
    }
}
