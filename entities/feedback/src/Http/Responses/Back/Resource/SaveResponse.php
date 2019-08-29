<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * SaveResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $id = $request->route('id', 0);
        $data = $request->all();

        $item = $this->resourceService->save($data, $id);

        return response()->redirectToRoute(
            'back.feedback.edit',
            [
                $item['id'],
            ]
        );
    }
}
