<?php

Route::get('/', 'DevController@render');

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

