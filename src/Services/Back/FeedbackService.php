<?php

namespace InetStudio\Feedback\Services\Back;

use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract;

/**
 * Class FeedbackService.
 */
class FeedbackService extends BaseService implements FeedbackServiceContract
{
    /**
     * FeedbackService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Feedback\Contracts\Models\FeedbackModelContract'));
    }

    /**
     * Получаем объект по id (для отображения).
     *
     * @param int $id
     * @param array $params
     *
     * @return FeedbackModelContract|null
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = []): ?FeedbackModelContract
    {
        $item = $this->getItemById($id, $params);

        if ($item->id && ! $item->is_read) {
            $item->update([
                'is_read' => true,
            ]);
        }

        return $item;
    }

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return FeedbackModelContract
     */
    public function save(array $data, int $id): FeedbackModelContract
    {
        $action = ($id) ? 'отредактировано' : 'создано';

        $data = array_merge($data, [
            'is_read' => 1,
        ]);

        $item = $this->saveModel($data, $id);

        $item->searchable();

        event(app()->makeWith('InetStudio\Feedback\Contracts\Events\Back\ModifyFeedbackEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Сообщение успешно '.$action);

        return $item;
    }

    /**
     * Получаем количество непрочитанных сообщений.
     *
     * @return int
     */
    public function getUnreadFeedbackCount(): int
    {
        return $this->model::unread()->count();
    }
}
