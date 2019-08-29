<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;

/**
 * Interface ModerateControllerContract.
 */
interface ModerateControllerContract
{
    /**
     * Пометка "прочитано".
     *
     * @param  Request  $request
     * @param  ReadResponseContract  $response
     *
     * @return ReadResponseContract
     */
    public function read(Request $request, ReadResponseContract $response): ReadResponseContract;

    /**
     * Удаление объектов.
     *
     * @param  Request  $request
     * @param  DestroyResponseContract  $response
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request, DestroyResponseContract $response): DestroyResponseContract;
}
