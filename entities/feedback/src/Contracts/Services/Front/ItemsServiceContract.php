<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Services\Front;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем сообщение.
     *
     * @param  array  $data
     *
     * @return FeedbackModelContract
     */
    public function save(array $data): FeedbackModelContract;
}
