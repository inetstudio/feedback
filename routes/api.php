<?php

Route::group([
    'namespace' => 'InetStudio\Feedback\Http\Controllers\API',
    'middleware' => ['web'],
    'prefix' => 'api/module/feedback',
], function () {
    Route::get('download/messages', 'DownloadsController@downloadMessages')->name('api.feedback.download');
});
