<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Front;

use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Requests\Front\SendItemRequestContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Front\SendItemResponseContract;

/**
 * Interface ItemsControllerContract.
 */
interface ItemsControllerContract
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param  SendItemRequestContract  $request
     * @param  SendItemResponseContract  $response
     *
     * @return SendItemResponseContract
     */
    public function send(SendItemRequestContract $request, SendItemResponseContract $response): SendItemResponseContract;
}
