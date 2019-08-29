<?php

namespace InetStudio\FeedbackPackage\Feedback\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var  array
     */
    public $bindings = [
        'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\FeedbackPackage\Feedback\Events\Back\ModifyItemEvent',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemResponseEventContract' => 'InetStudio\FeedbackPackage\Feedback\Events\Back\ModifyItemResponseEvent',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Front\SendItemEventContract' => 'InetStudio\FeedbackPackage\Feedback\Events\Front\SendItemEvent',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Exports\ItemsExportContract' => 'InetStudio\FeedbackPackage\Feedback\Exports\ItemsExport',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back\ResourceController',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\ModerateControllerContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back\ModerateController',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\ExportControllerContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back\ExportController',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back\DataController',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Controllers\Front\ItemsController',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Requests\Back\SaveItemRequest',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Requests\Front\SendItemRequestContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Requests\Front\SendItemRequest',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Export\ItemsExportResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Moderate\DestroyResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Moderate\ReadResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Front\SendItemResponseContract' => 'InetStudio\FeedbackPackage\Feedback\Http\Responses\Front\SendItemResponse',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\Front\AttachUserToItemsListenerContract' => 'InetStudio\FeedbackPackage\Feedback\Listeners\Front\AttachUserToItemsListener',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\SendEmailToAdminListenerContract' => 'InetStudio\FeedbackPackage\Feedback\Listeners\SendEmailToAdminListener',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\SendEmailToUserListenerContract' => 'InetStudio\FeedbackPackage\Feedback\Listeners\SendEmailToUserListener',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Back\ResponseMailContract' => 'InetStudio\FeedbackPackage\Feedback\Mail\Back\ResponseMail',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Front\NewItemMailContract' => 'InetStudio\FeedbackPackage\Feedback\Mail\Front\NewItemMail',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract' => 'InetStudio\FeedbackPackage\Feedback\Models\FeedbackModel',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Back\ResponseNotificationContract' => 'InetStudio\FeedbackPackage\Feedback\Notifications\Back\ResponseNotification',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Back\ResponseQueueableNotificationContract' => 'InetStudio\FeedbackPackage\Feedback\Notifications\Back\ResponseQueueableNotification',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemNotificationContract' => 'InetStudio\FeedbackPackage\Feedback\Notifications\Front\NewItemNotification',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemQueueableNotificationContract' => 'InetStudio\FeedbackPackage\Feedback\Notifications\Front\NewItemQueueableNotification',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\FeedbackPackage\Feedback\Services\Back\DataTables\IndexService',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\FeedbackPackage\Feedback\Services\Back\ItemsService',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ModerateServiceContract' => 'InetStudio\FeedbackPackage\Feedback\Services\Back\ModerateService',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\FeedbackPackage\Feedback\Services\Front\ItemsService',
        'InetStudio\FeedbackPackage\Feedback\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\FeedbackPackage\Feedback\Transformers\Back\Resource\IndexTransformer',
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
