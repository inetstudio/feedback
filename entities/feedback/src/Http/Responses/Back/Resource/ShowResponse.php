<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

class ShowResponse implements ShowResponseContract
{
    public function __construct(
        protected ItemsServiceContract $resourceService
    ) {}

    public function toResponse($request)
    {
        $id = $request->route('id');

        $item = $this->resourceService->getItemById($id);

        return response()->json($item->toArray());
    }
}
