<?php

namespace InetStudio\FeedbackPackage\Feedback\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;

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
     * Получаем объект по id (для отображения).
     *
     * @param  int  $id
     * @param  array  $params
     *
     * @return FeedbackModelContract|null
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = []): ?FeedbackModelContract
    {
        $item = $this->getItemById($id, $params);

        if ($item->id && ! $item->is_read) {
            $this->saveModel(
                [
                    'is_read' => true,
                ],
                $item->id
            );
        }

        return $item;
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return FeedbackModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): FeedbackModelContract
    {
        $action = ($id) ? 'отредактировано' : 'создано';

        $item = $this->getItemById($id);
        $oldResponse = $item['response'];

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        if ($oldResponse == '' && in_array('response', $item->getChanges())) {
            event(
                app()->make(
                    'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemResponseEventContract',
                    compact('item')
                )
            );
        }

        event(
            app()->make(
                'InetStudio\FeedbackPackage\Feedback\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Сообщение успешно '.$action);

        return $item;
    }

    /**
     * Получаем количество непрочитанных сообщений.
     *
     * @return int
     */
    public function getUnreadItemsCount(): int
    {
        return $this->model::unread()->count();
    }
}
