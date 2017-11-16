<?php

namespace InetStudio\Feedback\Observers;

use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\Feedback\Notifications\NewFeedbackNotification;
use InetStudio\Feedback\Notifications\NewFeedbackQueueableNotification;

class FeedbackObserver
{
    /**
     * Listen to the FeedbackModel created event.
     *
     * @param FeedbackModel $feedback
     */
    public function created(FeedbackModel $feedback): void
    {
        if (config('feedback.mails.to')) {
            if (config('feedback.queue.enable')) {
                $queue = config('feedback.queue.name') ?? 'feedback_notify';

                $feedback->notify((new NewFeedbackQueueableNotification($feedback))->onQueue($queue));
            } else {
                $feedback->notify(new NewFeedbackNotification($feedback));
            }
        }
    }
}
