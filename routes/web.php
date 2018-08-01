<?php

/**
 * home page route
 **/
Route::get('/', 'PagesController@homepage');

/**
 * Vladan's routes
 */
Route::get('beauty-box', 'DevController@render');
Route::get('shop', 'DevController@render');

/**
 * gallery page routes
 **/
Route::get('galerija/{category}/{post}/{id}', 'PagesController@gallery');
Route::get('galerija/{category1}/{category2}/{post}/{id}', 'PagesController@subGallery');

/**
 * images page routes
 **/
Route::get('slike/{category}/{post}/{id}', 'PagesController@images');
Route::get('slike/{category1}/{category2}/{post}/{id}', 'PagesController@subImages');

/**
 * filemanager route
 **/
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

/**
 * auth routes
 */
Auth::routes();

/**
 * admin dashboard route
 **/
Route::get('admin', function () {
    return view('layouts.admin-app');
});

/**
 * category page routes
 **/
Route::get('{category}', 'PagesController@category');
Route::get('{category1}/{category2}', 'PagesController@subCategory');

/**
 * post page routes
 **/
Route::get('{category}/{post}/{id}', 'PagesController@post');
Route::get('{category1}/{category2}/{post}/{id}', 'PagesController@subPost');

/**
 * test route
 */
Route::get('test', 'TestController@index');


