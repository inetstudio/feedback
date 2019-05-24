<?php

namespace InetStudio\Feedback\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class FeedbackBindingsServiceProvider.
 */
class FeedbackBindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\Feedback\Contracts\Models\FeedbackModelContract' => 'InetStudio\Feedback\Models\FeedbackModel',
        'InetStudio\Feedback\Contracts\Exports\FeedbackExportContract' => 'InetStudio\Feedback\Exports\FeedbackExport',
        'InetStudio\Feedback\Contracts\Transformers\Back\FeedbackTransformerContract' => 'InetStudio\Feedback\Transformers\Back\FeedbackTransformer',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Moderate\DestroyResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Moderate\ReadResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\Feedback\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\Feedback\Contracts\Http\Responses\Front\SendFeedbackResponseContract' => 'InetStudio\Feedback\Http\Responses\Front\SendFeedbackResponse',
        'InetStudio\Feedback\Contracts\Http\Requests\Back\SaveFeedbackRequestContract' => 'InetStudio\Feedback\Http\Requests\Back\SaveFeedbackRequest',
        'InetStudio\Feedback\Contracts\Http\Requests\Front\SendFeedbackRequestContract' => 'InetStudio\Feedback\Http\Requests\Front\SendFeedbackRequest',
        'InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackControllerContract' => 'InetStudio\Feedback\Http\Controllers\Back\FeedbackController',
        'InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackModerateControllerContract' => 'InetStudio\Feedback\Http\Controllers\Back\FeedbackModerateController',
        'InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackExportControllerContract' => 'InetStudio\Feedback\Http\Controllers\Back\FeedbackExportController',
        'InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackDataControllerContract' => 'InetStudio\Feedback\Http\Controllers\Back\FeedbackDataController',
        'InetStudio\Feedback\Contracts\Http\Controllers\Front\FeedbackControllerContract' => 'InetStudio\Feedback\Http\Controllers\Front\FeedbackController',
        'InetStudio\Feedback\Contracts\Events\Back\ModifyFeedbackEventContract' => 'InetStudio\Feedback\Events\Back\ModifyFeedbackEvent',
        'InetStudio\Feedback\Contracts\Events\Front\SendFeedbackEventContract' => 'InetStudio\Feedback\Events\Front\SendFeedbackEvent',
        'InetStudio\Feedback\Contracts\Listeners\Front\SendEmailToAdminListenerContract' => 'InetStudio\Feedback\Listeners\Front\SendEmailToAdminListener',
        'InetStudio\Feedback\Contracts\Listeners\Front\AttachUserToFeedbackListenerContract' => 'InetStudio\Feedback\Listeners\Front\AttachUserToFeedbackListener',
        'InetStudio\Feedback\Contracts\Mail\NewFeedbackMailContract' => 'InetStudio\Feedback\Mail\NewFeedbackMail',
        'InetStudio\Feedback\Contracts\Notifications\NewFeedbackNotificationContract' => 'InetStudio\Feedback\Notifications\NewFeedbackNotification',
        'InetStudio\Feedback\Contracts\Notifications\NewFeedbackQueueableNotificationContract' => 'InetStudio\Feedback\Notifications\NewFeedbackQueueableNotification',
        'InetStudio\Feedback\Contracts\Services\Back\FeedbackDataTableServiceContract' => 'InetStudio\Feedback\Services\Back\FeedbackDataTableService',
        'InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract' => 'InetStudio\Feedback\Services\Back\FeedbackService',
        'InetStudio\Feedback\Contracts\Services\Back\FeedbackModerateServiceContract' => 'InetStudio\Feedback\Services\Back\FeedbackModerateService',
        'InetStudio\Feedback\Contracts\Services\Front\FeedbackServiceContract' => 'InetStudio\Feedback\Services\Front\FeedbackService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
