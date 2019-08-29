<?php

namespace InetStudio\FeedbackPackage\Feedback\Notifications\Back;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Back\ResponseMailContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Back\ResponseNotificationContract;

/**
 * Class ResponseNotification.
 */
class ResponseNotification extends Notification implements ResponseNotificationContract
{
    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * ResponseNotification constructor.
     *
     * @param  FeedbackModelContract  $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail',
            'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return ResponseMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): ResponseMailContract
    {
        return app()->make(
            ResponseMailContract::class,
            [
                'item' => $this->item,
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'feedback_id' => $this->item['id'],
        ];
    }
}
