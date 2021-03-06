<?php

namespace InetStudio\FeedbackPackage\Feedback\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var FeedbackModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  FeedbackModelContract  $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }
}
