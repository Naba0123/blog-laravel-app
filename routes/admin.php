<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
        Route::get('/', 'IndexController@index');
        Route::prefix('/auth')->name('auth.')->group(function() {
            Route::post('/logout', 'AuthController@logout')->name('logout');
        });
        // Dashboard
        Route::prefix('/dashboard')->name('dashboard.')->group(function() {
            Route::get('/', 'DashboardController@index')->name('index');
        });
        // Article
        Route::prefix('/article')->name('article.')->group(function() {
            Route::get('/list', 'ArticleController@list')->name('list');
            Route::get('/edit', 'ArticleController@edit')->name('edit');
            Route::post('/save', 'ArticleController@save')->name('save');
            Route::post('/delete', 'ArticleController@delete')->name('delete');
        });
        Route::prefix('/category')->name('category.')->group(function() {
            Route::get('/list', 'CategoryController@list')->name('list');
        });
        // Setting
        Route::prefix('/setting')->name('setting.')->group(function() {
            Route::get('/general', 'SettingController@general')->name('general');
            Route::post('/general/save', 'SettingController@saveGeneral')->name('general.save');
        });
    });
});
