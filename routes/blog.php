<?php

Route::name('main.')->group(function() {
    Route::get('/', 'MainController@index')->name('index');
});

Route::name('article.')->prefix('/article')->group(function() {
    Route::get('/list', 'ArticleController@list')->name('list');
    Route::get('/{article_id}', 'ArticleController@detail')->name('detail');
});

Route::name('category.')->prefix('/category')->group(function() {
    Route::get('/{category_id}', 'CategoryController@detail')->name('detail');
});

