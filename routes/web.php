<?php

Route::group(['namespace' => 'InetStudio\Feedback\Controllers'], function () {
    Route::group(['middleware' => 'web', 'prefix' => 'back'], function () {
        Route::group(['middleware' => 'back.auth'], function () {
            Route::any('feedback/data', 'FeedbackController@data')->name('back.feedback.data');
            Route::resource('feedback', 'FeedbackController', ['only' => [
                'index', 'edit', 'destroy',
            ], 'as' => 'back']);
        });
    });
});
