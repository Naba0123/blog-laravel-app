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

Route::prefix('/admin')->namespace('Admin')->name('admin.')->group(function() {
    Route::middleware(['guest'])->group(function() {
        Route::prefix('/auth')->name('auth.')->group(function() {
            Route::get('/', 'AuthController@index')->name('index');
            Route::post('/login', 'AuthController@login')->name('login');
            Route::post('/logout', 'AuthController@logout')->name('logout');
        });
    });
    Route::middleware(['auth'])->group(function() {
        Route::get('/', 'IndexController@index')->name('index');
    });

});
