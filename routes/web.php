<?php

Route::group([
    'namespace' => 'InetStudio\Feedback\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/feedback',
], function () {
    Route::get('export', 'FeedbackExportControllerContract@exportFeedback')->name('back.feedback.export');
});

Route::group(['namespace' => 'InetStudio\Feedback\Http\Controllers\Back'], function () {
    Route::group(['middleware' => 'web', 'prefix' => 'back'], function () {
        Route::group(['middleware' => 'back.auth'], function () {
            Route::any('feedback/data', 'FeedbackController@data')->name('back.feedback.data');
            Route::resource('feedback', 'FeedbackController', ['only' => [
                'index', 'edit', 'destroy',
            ], 'as' => 'back']);
        });
    });
});

Route::group(['namespace' => 'InetStudio\Feedback\Http\Controllers\Front'], function () {
    Route::group(['middleware' => 'web'], function () {
        Route::post('feedback/send', 'FeedbackController@sendFeedback')->name('front.feedback.send');
    });
});
