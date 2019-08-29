<?php

namespace InetStudio\FeedbackPackage\Feedback\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ModerateServiceContract;

/**
 * Class ModerateService.
 */
class ModerateService extends BaseService implements ModerateServiceContract
{
    /**
     * ModerateService constructor.
     *
     * @param  FeedbackModelContract  $model
     */
    public function __construct(FeedbackModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param  array  $params
     *
     * @return bool
     *
     * @throws BindingResolutionException
     */
    public function updateRead($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update(
                [
                    'is_read' => 1,
                ]
            );

            event(
                app()->make(
                    'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemEventContract',
                    compact('item')
                )
            );
        }

        return true;
    }
}
