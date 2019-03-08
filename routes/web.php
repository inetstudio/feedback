<?php

Route::group([
    'namespace' => 'InetStudio\Feedback\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back',
], function () {
    Route::get('feedback/export', 'FeedbackExportControllerContract@exportFeedback')->name('back.feedback.export');
    Route::any('feedback/data', 'FeedbackDataControllerContract@data')->name('back.feedback.data.index');

    Route::post('feedback/moderate/read', 'FeedbackModerateControllerContract@read')->name('back.feedback.moderate.read');
    Route::post('feedback/moderate/destroy', 'FeedbackModerateControllerContract@destroy')->name('back.feedback.moderate.destroy');
    
    Route::resource('feedback', 'FeedbackControllerContract', [
        'as' => 'back',
    ]);
});

Route::group([
    'namespace' => 'InetStudio\Feedback\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
], function () {
    Route::post('feedback/send', 'FeedbackControllerContract@sendFeedback')->name('front.feedback.send');
});
