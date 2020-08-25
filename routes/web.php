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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'todo'], function () {
        Route::get('/', 'Admin\TodoController@index');
        Route::get('create', 'Admin\TodoController@add');
        Route::post('create', 'Admin\TodoController@create');
        Route::get('edit', 'Admin\TodoController@edit');
        Route::post('edit', 'Admin\TodoController@update');
        Route::get('delete', 'Admin\TodoController@delete');
        Route::get('completed', 'Admin\TodoController@completed');
        Route::post('complete', 'Admin\TodoController@complete');
        Route::post('uncomplete', 'Admin\TodoController@uncomplete');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
