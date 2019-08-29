<?php

namespace InetStudio\FeedbackPackage\Feedback\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\SendEmailToUserListenerContract;

/**
 * Class SendEmailToUserListener.
 */
class SendEmailToUserListener implements SendEmailToUserListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $item = $event->item;

        if (config('feedback.mails_users.send')) {
            if (config('feedback.queue.enable')) {
                $queue = config('feedback.queue.name', 'feedback_notify');

                $item->notify(
                    app()->make(
                        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Back\ResponseQueueableNotificationContract',
                        compact('item')
                    )->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->make(
                        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Back\ResponseNotificationContract',
                        compact('item')
                    )
                );
            }
        }
    }
}
