<?php

Route::get('/', 'DevController@render');
Route::get('/{view}', 'DevController@render');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('test', 'TestController@index');

