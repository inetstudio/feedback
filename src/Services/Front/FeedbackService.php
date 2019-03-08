<?php

namespace InetStudio\Feedback\Services\Front;

use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Services\Front\FeedbackServiceContract;

/**
 * Class FeedbackService.
 */
class FeedbackService implements FeedbackServiceContract
{
    /**
     * Сохраняем отзыв.
     *
     * @param array $data
     *
     * @return FeedbackModelContract
     */
    public function sendFeedback(array $data): FeedbackModelContract
    {
        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');

        $request = request();

        $data = array_merge($data, [
            'user_id' => $usersService->getUserId(),
            'name' => $usersService->getUserName($request),
            'email' => $usersService->getUserEmail($request),
        ]);

        $item = $this->saveModel($data);

        if ($item && $item->id) {
            event(app()->makeWith('InetStudio\Feedback\Contracts\Events\Front\SendFeedbackEventContract', [
                'object' => $item,
            ]));
        }

        return $item;
    }
}
