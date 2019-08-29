<?php

namespace InetStudio\FeedbackPackage\Feedback\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Events\Front\SendItemEventContract;

/**
 * Class SendItemEvent.
 */
class SendItemEvent implements SendItemEventContract
{
    use SerializesModels;

    /**
     * @var FeedbackModelContract
     */
    public $item;

    /**
     * SendItemEvent constructor.
     *
     * @param  FeedbackModelContract  $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }
}
