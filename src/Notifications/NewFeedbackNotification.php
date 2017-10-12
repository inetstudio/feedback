<?php

namespace InetStudio\Feedback\Notifications;

use Illuminate\Notifications\Notification;
use InetStudio\Feedback\Mail\NewFeedbackMail;
use InetStudio\Feedback\Models\FeedbackModel;

class NewFeedbackNotification extends Notification
{
    protected $feedback;

    /**
     * NewFeedbackNotification constructor.
     *
     * @param FeedbackModel $feedback
     */
    public function __construct(FeedbackModel $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     * @return NewFeedbackMail
     */
    public function toMail($notifiable)
    {
        return (new NewFeedbackMail($this->feedback));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'feedback_id' => $this->feedback->id,
        ];
    }
}
