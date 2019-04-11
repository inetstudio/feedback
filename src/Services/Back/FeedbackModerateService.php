<?php

namespace InetStudio\Feedback\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackModerateServiceContract;

/**
 * Class FeedbackModerateService.
 */
class FeedbackModerateService extends BaseService implements FeedbackModerateServiceContract
{
    /**
     * FeedbackModerateService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Feedback\Contracts\Models\FeedbackModelContract'));
    }

    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param array $params
     *
     * @return bool
     */
    public function updateRead($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update([
                'is_read' => 1,
            ]);

            event(app()->makeWith('InetStudio\Feedback\Contracts\Events\Back\ModifyFeedbackEventContract', [
                'object' => $item,
            ]));
        }

        return true;
    }
}
