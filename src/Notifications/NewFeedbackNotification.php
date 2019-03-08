<?php

namespace InetStudio\Feedback\Notifications;

use Illuminate\Notifications\Notification;
use InetStudio\Feedback\Contracts\Mail\NewFeedbackMailContract;
use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Notifications\NewFeedbackNotificationContract;

/**
 * Class NewFeedbackNotification.
 */
class NewFeedbackNotification extends Notification implements NewFeedbackNotificationContract
{
    protected $item;

    /**
     * NewFeedbackNotification constructor.
     *
     * @param FeedbackModelContract $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail', 'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return NewFeedbackMailContract
     */
    public function toMail($notifiable): NewFeedbackMailContract
    {
        return app()->makeWith(NewFeedbackMailContract::class, ['item' => $this->item]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'feedback_id' => $this->item->id,
        ];
    }
}
