<?php

namespace InetStudio\FeedbackPackage\Feedback\Notifications\Front;

use Illuminate\Bus\Queueable;
use InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemQueueableNotificationContract;

/**
 * Class NewItemQueueableNotification.
 */
class NewItemQueueableNotification extends NewItemNotification implements NewItemQueueableNotificationContract
{
    use Queueable;
}
