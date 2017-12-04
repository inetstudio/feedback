<?php

namespace InetStudio\Feedback\Http\Controllers\Front;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Services\Front\FeedbackService;
use InetStudio\Feedback\Http\Requests\Front\SendFeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param SendFeedbackRequest $request
     * @param FeedbackService $feedbackService
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFeedback(SendFeedbackRequest $request,
                                 FeedbackService $feedbackService): JsonResponse
    {
        $feedback = $feedbackService->saveFeedback($request);

        $result = ($feedback && isset($feedback->id));

        return response()->json([
            'success' => $result,
            'message' => ($result) ? trans('feedback::messages.send_success') : trans('feedback::messages.send_fail'),
        ]);
    }
}
