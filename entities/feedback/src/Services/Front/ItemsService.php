<?php

namespace InetStudio\FeedbackPackage\Feedback\Services\Front;

use Illuminate\Support\Arr;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  FeedbackModelContract  $model
     */
    public function __construct(FeedbackModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем сообщение.
     *
     * @param  array  $data
     *
     * @return FeedbackModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data): FeedbackModelContract
    {
        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract');

        $request = request();

        $data = array_merge(
            $data,
            [
                'user_id' => $usersService->getUserId(),
                'name' => $usersService->getUserName($request),
                'email' => $usersService->getUserEmail($request),
                'feedbackable_type' => $data['feedbackable_type'] ?? null,
                'feedbackable_id' => $data['feedbackable_id'] ?? null,
            ]
        );

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData);

        if ($item && $item->id) {
            event(
                app()->make(
                    'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Front\SendItemEventContract',
                    compact('item')
                )
            );
        }

        return $item;
    }
}
