<?php

namespace InetStudio\Feedback\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackServiceContract;
use InetStudio\Feedback\Contracts\Http\Requests\Back\SaveFeedbackRequestContract;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackDataTableServiceContract;
use InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackControllerContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Class FeedbackController.
 */
class FeedbackController extends Controller implements FeedbackControllerContract
{
    /**
     * Список объектов.
     *
     * @param FeedbackDataTableServiceContract $datatablesService
     *
     * @return IndexResponseContract
     */
    public function index(FeedbackDataTableServiceContract $datatablesService): IndexResponseContract
    {
        $table = $datatablesService->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(FeedbackServiceContract $feedbackService, int $id = 0): ShowResponseContract
    {
        $item = $feedbackService->getItemById($id);

        return app()->makeWith(ShowResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     *
     * @return FormResponseContract
     */
    public function create(FeedbackServiceContract $feedbackService): FormResponseContract
    {
        $item = $feedbackService->getItemById();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param SaveFeedbackRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(FeedbackServiceContract $feedbackService, SaveFeedbackRequestContract $request): SaveResponseContract
    {
        return $this->save($feedbackService, $request);
    }

    /**
     * Редактирование объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(FeedbackServiceContract $feedbackService, int $id = 0): FormResponseContract
    {
        $item = $feedbackService->getItemByIdForDisplay($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param SaveFeedbackRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(FeedbackServiceContract $feedbackService, SaveFeedbackRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($feedbackService, $request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param SaveFeedbackRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    protected function save(FeedbackServiceContract $feedbackService, SaveFeedbackRequestContract $request, int $id = 0): SaveResponseContract
    {
        $data = $request->only($feedbackService->getModel()->getFillable());

        $item = $feedbackService->save($data, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(FeedbackServiceContract $feedbackService, int $id = 0): DestroyResponseContract
    {
        $result = $feedbackService->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => (!! $result),
        ]);
    }
}
