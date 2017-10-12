<?php

namespace InetStudio\Feedback\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewFeedbackQueueableNotification extends NewFeedbackNotification implements ShouldQueue
{
    use Queueable;
}
