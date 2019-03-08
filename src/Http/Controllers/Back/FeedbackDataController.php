<?php

namespace InetStudio\Feedback\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackDataTableServiceContract;
use InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackDataControllerContract;

/**
 * Class FeedbackDataController.
 */
class FeedbackDataController extends Controller implements FeedbackDataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param FeedbackDataTableServiceContract $datatablesService
     *
     * @return JsonResponse
     */
    public function data(FeedbackDataTableServiceContract $datatablesService): JsonResponse
    {
        return $datatablesService->ajax();
    }
}
