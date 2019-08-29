<?php

namespace InetStudio\FeedbackPackage\Feedback\Notifications\Front;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Front\NewItemMailContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Notifications\Front\NewItemNotificationContract;

/**
 * Class NewItemNotification.
 */
class NewItemNotification extends Notification implements NewItemNotificationContract
{
    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * NewItemNotification constructor.
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
     * @return NewItemMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): NewItemMailContract
    {
        return app()->make(
            NewItemMailContract::class,
            ['item' => $this->item]
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
