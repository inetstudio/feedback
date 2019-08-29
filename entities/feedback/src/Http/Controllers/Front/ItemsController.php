<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Controllers\Front;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Requests\Front\SendItemRequestContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Front\SendItemResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Front\ItemsControllerContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param  SendItemRequestContract  $request
     * @param  SendItemResponseContract  $response
     *
     * @return SendItemResponseContract
     */
    public function send(SendItemRequestContract $request, SendItemResponseContract $response): SendItemResponseContract
    {
        return $response;
    }
}
