<?php

namespace InetStudio\FeedbackPackage\Feedback\Listeners\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\Front\AttachUserToItemsListenerContract;

/**
 * Class AttachUserToItemsListener.
 */
class AttachUserToItemsListener implements AttachUserToItemsListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $feedbackService = app()->make('InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract');

        $user = $event->user;

        $feedbackService->getModel()::where(
            [
                ['user_id', '=', 0],
                ['email', '=', $user->email],
            ]
        )->update(
            [
                'user_id' => $user->id,
                'name' => $user->name,
            ]
        );
    }
}
