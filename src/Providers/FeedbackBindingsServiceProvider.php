<?php

namespace InetStudio\Feedback\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class FeedbackBindingsServiceProvider.
 */
class FeedbackBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var bool
    */
    protected $defer = true;

    /**
    * @var array
    */
    public $bindings = [
        'InetStudio\Feedback\Contracts\Exports\FeedbackExportContract' => 'InetStudio\Feedback\Exports\FeedbackExport',
        'InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackExportControllerContract' => 'InetStudio\Feedback\Http\Controllers\Back\FeedbackExportController',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
