<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Получаем объект по id (для отображения).
     *
     * @param  int  $id
     * @param  array  $params
     *
     * @return FeedbackModelContract|null
     */
    public function getItemByIdForDisplay(int $id = 0, array $params = []): ?FeedbackModelContract;

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return FeedbackModelContract
     */
    public function save(array $data, int $id): FeedbackModelContract;

    /**
     * Получаем количество непрочитанных сообщений.
     *
     * @return int
     */
    public function getUnreadItemsCount(): int;
}
