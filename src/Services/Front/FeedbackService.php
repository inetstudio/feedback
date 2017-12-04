<?php

namespace InetStudio\Feedback\Services\Front;

use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\Feedback\Http\Requests\Front\SendFeedbackRequest;

class FeedbackService
{
    /**
     * Сохраняем отзыв.
     *
     * @param SendFeedbackRequest $request
     * @return FeedbackModel
     */
    public function saveFeedback(SendFeedbackRequest $request): FeedbackModel
    {
        $usersService = app()->make('UsersService');

        return FeedbackModel::create([
            'user_id' => $usersService->getUserId(),
            'name' => $usersService->getUserName($request),
            'email' => $usersService->getUserEmail($request),
            'message' => strip_tags($request->get('message')),
        ]);
    }
}
