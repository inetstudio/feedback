<?php

namespace InetStudio\Feedback\Listeners;

/**
 * Class AttachUserToFeedbackListener.
 */
class AttachUserToFeedbackListener
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return void
     */
    public function handle($event): void
    {
        $feedbackService = app()->make('InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract');

        $user = $event->user;

        $feedbackService->getModel()::where([
            ['user_id', '=', 0],
            ['email', '=', $user->email],
        ])->update([
            'user_id' => $user->id,
            'name' => $user->name,
        ]);
    }
}
