<?php

namespace InetStudio\Feedback\Listeners\Front;

use InetStudio\Feedback\Contracts\Listeners\Front\SendEmailToAdminListenerContract;

/**
 * Class SendEmailToAdminListener.
 */
class SendEmailToAdminListener implements SendEmailToAdminListenerContract
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $item = $event->object;

        if (config('feedback.mails_admins.send')) {
            if (config('feedback.queue.enable')) {
                $queue = config('feedback.queue.name') ?? 'feedback_notify';

                $item->notify(
                    app()->makeWith('InetStudio\Feedback\Contracts\Notifications\NewFeedbackQueueableNotificationContract', compact('item'))
                        ->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->makeWith('InetStudio\Feedback\Contracts\Notifications\NewFeedbackNotificationContract', compact('item'))
                );
            }
        }
    }
}
