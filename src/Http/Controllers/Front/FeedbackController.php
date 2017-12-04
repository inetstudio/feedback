<?php

namespace InetStudio\Feedback\Http\Controllers\Front;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Http\Requests\Front\SendFeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param SendFeedbackRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFeedback(SendFeedbackRequest $request): JsonResponse
    {
        $feedbackService = app()->make('FeedbackService');

        $feedback = $feedbackService->saveFeedback($request);

        $result = ($feedback && isset($feedback->id));

        return response()->json([
            'success' => $result,
            'message' => ($result) ? trans('feedback::messages.send_success') : trans('feedback::messages.send_fail'),
        ]);
    }
}
