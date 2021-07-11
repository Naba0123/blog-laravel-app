<?php

Route::name('main.')->group(function() {
    Route::get('/', 'MainController@index')->name('index');
});

Route::name('article.')->prefix('/article')->group(function() {
    Route::get('/list', 'ArticleController@list')->name('list');
    Route::get('/{id}', 'ArticleController@detail')->name('detail');
});


