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
    // 未ログイン
    Route::middleware(['guest'])->group(function() {
        Route::prefix('/auth')->name('auth.')->group(function() {
            Route::get('/', 'AuthController@index')->name('index');
            Route::post('/login', 'AuthController@login')->name('login');
        });
    });
    // ログイン済み
    Route::middleware(['auth'])->group(function() {
        Route::prefix('/auth')->name('auth.')->group(function() {
            Route::post('/logout', 'AuthController@logout')->name('logout');
        });
        // Dashboard
        Route::get('/', 'DashboardController@index')->name('index');
        // Article
        Route::prefix('/article')->name('article.')->group(function() {
            Route::get('/', 'ArticleController@index')->name('index');
        });
        // Setting
        Route::prefix('/setting')->name('setting.')->group(function() {
            Route::get('/general', 'SettingController@general')->name('general');
        });
    });
});
