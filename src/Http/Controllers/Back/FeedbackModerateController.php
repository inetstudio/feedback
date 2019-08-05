<?php

namespace InetStudio\Feedback\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackModerateServiceContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackModerateControllerContract;

/**
 * Class FeedbackModerateController.
 */
class FeedbackModerateController extends Controller implements FeedbackModerateControllerContract
{
    /**
     * Пометка "прочитано".
     *
     * @param Request $request
     * @param FeedbackModerateServiceContract $moderateService
     *
     * @return ReadResponseContract
     */
    public function read(Request $request, FeedbackModerateServiceContract $moderateService): ReadResponseContract
    {
        $ids = $request->get('feedback') ?? [];

        $result = $moderateService->updateRead($ids);

        return app()->makeWith(ReadResponseContract::class, compact('result'));
    }

    /**
     * Удаление объектов.
     *
     * @param Request $request
     * @param FeedbackModerateServiceContract $moderateService
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request, FeedbackModerateServiceContract $moderateService): DestroyResponseContract
    {
        $ids = $request->get('feedback') ?? [];

        $result = $moderateService->destroy($ids);

        return app()->makeWith(DestroyResponseContract::class, compact('result'));
    }
}
