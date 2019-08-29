<?php

namespace InetStudio\FeedbackPackage\Feedback\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemResponseEventContract;

/**
 * Class ModifyItemResponseEvent.
 */
class ModifyItemResponseEvent implements ModifyItemResponseEventContract
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
