<?php

namespace InetStudio\Feedback\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\Feedback\Contracts\Events\Back\ModifyFeedbackEventContract;

/**
 * Class ModifyFeedbackEvent.
 */
class ModifyFeedbackEvent implements ModifyFeedbackEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyFeedbackEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
