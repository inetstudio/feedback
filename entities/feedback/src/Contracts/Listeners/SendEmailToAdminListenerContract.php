<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Listeners;

/**
 * Interface SendEmailToAdminListenerContract.
 */
interface SendEmailToAdminListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle($event): void;
}
