<?php

Route::name('main.')->group(function() {
    Route::get('/', 'MainController@index')->name('index');
});

Route::name('article.')->group(function() {
    Route::get('/list', 'ArticleController@list')->name('list');
});


