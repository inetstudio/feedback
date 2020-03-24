<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Listeners\Front;

/**
 * Interface AttachUserToItemsListenerContract.
 */
interface AttachUserToItemsListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void;
}
