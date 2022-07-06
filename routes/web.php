<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('blog/create', 'Admin\BlogController@add')->middleware('auth');
    Route::post('blog/create', 'Admin\BlogController@create')->middleware('auth');
    Route::get('blog', 'Admin\BlogController@index')->middleware('auth');
    Route::get('blog/edit', 'Admin\BlogController@edit')->middleware('auth');
    Route::post('blog/edit', 'Admin\BlogController@update')->middleware('auth');
    Route::get('blog/delete', 'Admin\BlogController@delete')->middleware('auth');
    
    Route::get('cat/create', 'Admin\CatController@add')->middleware('auth');
    Route::post('cat/create', 'Admin\CatController@create')->middleware('auth');
    Route::get('cat', 'Admin\CatController@index')->middleware('auth');
    Route::get('cat/edit', 'Admin\CatController@edit')->middleware('auth');
    Route::post('cat/edit', 'Admin\CatController@update')->middleware('auth');
    Route::get('cat/delete', 'Admin\CatController@delete')->middleware('auth');
    
    Route::get('drink/create', 'Admin\DrinkController@add')->middleware('auth');
    Route::post('drink/create', 'Admin\DrinkController@create')->middleware('auth');
    Route::get('drink', 'Admin\DrinkController@index')->middleware('auth');
    Route::get('drink/edit', 'Admin\DrinkController@edit')->middleware('auth');
    Route::post('drink/edit', 'Admin\DrinkController@update')->middleware('auth');
    Route::get('drink/delete', 'Admin\DrinkController@delete')->middleware('auth');
    
    Route::get('goods/create', 'Admin\GoodsController@add')->middleware('auth');
    Route::post('goods/create', 'Admin\GoodsController@create')->middleware('auth');
    Route::get('goods', 'Admin\GoodsController@index')->middleware('auth');
    Route::get('goods/edit', 'Admin\GoodsController@edit')->middleware('auth');
    Route::post('goods/edit', 'Admin\GoodsController@update')->middleware('auth');
    Route::get('goods/delete', 'Admin\GoodsController@delete')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
