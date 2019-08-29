<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back',
    ],
    function () {
        Route::get('feedback/export/items', 'ExportControllerContract@exportItems')
            ->name('back.feedback.export');

        Route::any('feedback/data/index', 'DataControllerContract@getIndexData')
            ->name('back.feedback.data.index');

        Route::post('feedback/moderate/read', 'ModerateControllerContract@read')
            ->name('back.feedback.moderate.read');

        Route::post('feedback/moderate/destroy', 'ModerateControllerContract@destroy')
            ->name('back.feedback.moderate.destroy');

        Route::resource(
            'feedback',
            'ResourceControllerContract',
            [
                'as' => 'back',
            ]
        )->parameters(
            [
                'feedback' => 'id'
            ]
        );
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::post('feedback/send', 'ItemsControllerContract@send')
            ->name('front.feedback.send');
    }
);
