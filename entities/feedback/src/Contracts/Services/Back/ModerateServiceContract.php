<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ModerateServiceContract.
 */
interface ModerateServiceContract extends BaseServiceContract
{
    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param  array  $params
     *
     * @return bool
     */
    public function updateRead($ids, array $params = []): bool;
}
