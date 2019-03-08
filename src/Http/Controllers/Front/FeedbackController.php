<?php

namespace InetStudio\Feedback\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use InetStudio\Feedback\Contracts\Services\Front\FeedbackServiceContract;
use InetStudio\Feedback\Contracts\Http\Requests\Front\SendFeedbackRequestContract;
use InetStudio\Feedback\Contracts\Http\Responses\Front\SendFeedbackResponseContract;

/**
 * Class FeedbackController.
 */
class FeedbackController extends Controller
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param SendFeedbackRequestContract $request
     *
     * @return SendFeedbackResponseContract
     */
    public function sendFeedback(FeedbackServiceContract $feedbackService, SendFeedbackRequestContract $request): SendFeedbackResponseContract
    {
        $data = $request->only($feedbackService->model->getFillable());

        $item = $feedbackService->sendFeedback($data);

        $result = ($item && isset($item->id));

        return app()->makeWith(SendFeedbackResponseContract::class, compact('result'));
    }
}
