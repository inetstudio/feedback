<?php

namespace InetStudio\FeedbackPackage\Feedback\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\SendEmailToAdminListenerContract;

/**
 * Class SendEmailToAdminListener.
 */
class SendEmailToAdminListener implements SendEmailToAdminListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $item = $event->item;

        if (config('feedback.mails_admins.send')) {
            if (config('feedback.queue.enable')) {
                $queue = config('feedback.queue.name', 'feedback_notify');

                $item->notify(
                    app()->make(
                        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemQueueableNotificationContract',
                        compact('item')
                    )->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->make(
                        'InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemNotificationContract',
                        compact('item')
                    )
                );
            }
        }
    }
}
