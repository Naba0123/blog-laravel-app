<?php

Route::name('main.')->group(function() {
    Route::get('/', 'MainController@index')->name('index');
});
