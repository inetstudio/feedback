<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\ModerateControllerContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;

/**
 * Class ModerateController.
 */
class ModerateController extends Controller implements ModerateControllerContract
{
    /**
     * Пометка "прочитано".
     *
     * @param  Request  $request
     * @param  ReadResponseContract  $response
     *
     * @return ReadResponseContract
     */
    public function read(Request $request, ReadResponseContract $response): ReadResponseContract
    {
        return $response;
    }

    /**
     * Удаление объектов.
     *
     * @param  Request  $request
     * @param  DestroyResponseContract  $response
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request, DestroyResponseContract $response): DestroyResponseContract
    {
        return $response;
    }
}
