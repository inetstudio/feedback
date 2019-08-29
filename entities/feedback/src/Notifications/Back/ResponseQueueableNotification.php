<?php

namespace InetStudio\FeedbackPackage\Feedback\Notifications\Back;

use Illuminate\Bus\Queueable;
use InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerQueueableNotificationContract;

/**
 * Class ResponseQueueableNotification.
 */
class ResponseQueueableNotification extends ResponseNotification implements AnswerQueueableNotificationContract
{
    use Queueable;
}
