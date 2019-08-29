<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Listeners;

/**
 * Interface SendEmailToUserListenerContract.
 */
interface SendEmailToUserListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void;
}
