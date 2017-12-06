<?php

namespace InetStudio\Feedback\Listeners;

use InetStudio\Feedback\Models\FeedbackModel;

class AttachUserToFeedbackListener
{
    /**
     * AttachUserToFeedbackListener constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event): void
    {
        $user = $event->user;

        $messages = FeedbackModel::where('user_id', 0)->where('email', $user->email)->get();

        foreach ($messages as $message) {
            $message->user_id = $user->id;
            $message->name = $user->name;
            $message->save();
        }
    }
}
