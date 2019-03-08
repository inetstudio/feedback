<?php

namespace InetStudio\Feedback\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\Feedback\Contracts\Notifications\NewFeedbackQueueableNotificationContract;

/**
 * Class NewFeedbackQueueableNotification.
 */
class NewFeedbackQueueableNotification extends NewFeedbackNotification implements NewFeedbackQueueableNotificationContract, ShouldQueue
{
    use Queueable;
}
