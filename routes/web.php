<?php

Route::get('/', 'PagesController@homepage');

Route::get('galerija/{category}/{post}/{id}', 'PagesController@gallery');

Route::get('galerija/{category1}/{category2}/{post}/{id}', 'PagesController@subGallery');

Route::get('{category2}/{category3}', 'PagesController@subCategory');

Route::get('{category}/{post}/{id}', 'PagesController@post');

Route::get('{category1}/{category2}/{post}/{id}', 'PagesController@subPost');

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::get('home', 'HomeController@index')->name('home');

Route::get('admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('test', 'TestController@index');

/**
 * ostavi ovu rutu poslednju, jer je ona zamena sa osvale rute
 */
Route::get('{view}', 'DevController@render');

