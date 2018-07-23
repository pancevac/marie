<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function () {

    Route::resource('banners', 'Api\BannersController');

    Route::get('brands/lists', 'Api\BrandsController@lists');
    Route::resource('brands', 'Api\BrandsController');

    Route::get('blogs/tree', 'Api\BlogsController@tree');
    Route::get('blogs/lists', 'Api\BlogsController@lists');
    Route::resource('blogs', 'Api\BlogsController');

    Route::get('categories/tree', 'Api\CategoriesController@tree');
    Route::get('categories/sort', 'Api\CategoriesController@sort');
    Route::get('categories/lists', 'Api\CategoriesController@lists');
    Route::post('categories/order', 'Api\CategoriesController@saveOrder');
    Route::resource('categories', 'Api\CategoriesController');

    Route::resource('menus', 'Api\MenusController');

    Route::get('menu-links/lists', 'Api\MenuLinksController@lists');
    Route::resource('menu-links', 'Api\MenuLinksController');
    Route::get('menu-links/{id}/sort', 'Api\MenuLinksController@sort');
    Route::post('menu-links/{id}/order', 'Api\MenuLinksController@saveOrder');

    Route::resource('permissions', 'Api\PermissionsController');

    Route::resource('posts', 'Api\PostsController');
    Route::post('posts/search', 'Api\PostsController@search');

    Route::resource('products', 'Api\ProductsController');
    Route::post('products/search', 'Api\ProductsController@search');

    Route::get('roles/lists', 'Api\RolesController@lists');
    Route::resource('roles', 'Api\RolesController');

    Route::resource('settings', 'Api\SettingsController');

    Route::resource('subscribers', 'Api\SubscribersController');

    Route::resource('tags', 'Api\TagsController');
    Route::post('tags/search', 'Api\TagsController@search');

    Route::resource('users', 'Api\UsersController');
    Route::post('users/{id}/change-password', 'Api\UsersController@changePassword');

    Route::get('user', function (Request $request) {
        return $request->user();
    });

});
