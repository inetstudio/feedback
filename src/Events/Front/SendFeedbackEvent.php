<?php

namespace InetStudio\Feedback\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\Feedback\Contracts\Events\Front\SendFeedbackEventContract;

/**
 * Class SendFeedbackEvent.
 */
class SendFeedbackEvent implements SendFeedbackEventContract
{
    use SerializesModels;

    public $object;

    /**
     * SendFeedbackEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
