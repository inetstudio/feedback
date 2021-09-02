<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

class DestroyResponse implements DestroyResponseContract
{
    public function __construct(
        protected ItemsServiceContract $resourceService
    ) {}

    public function toResponse($request)
    {
        $id = $request->route('id');

        $result = $this->resourceService->destroy($id);

        return response()->json(
            [
                'success' => $result,
            ]
        );
    }
}
