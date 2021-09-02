<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\EditResponseContract;

class EditResponse implements EditResponseContract
{
    public function __construct(
        protected ItemsServiceContract $resourceService
    ) {}

    public function toResponse($request)
    {
        $id = $request->route('id', 0);

        $item = $this->resourceService->getItemByIdForDisplay($id);

        return view(
            'admin.module.feedback::back.pages.form',
            compact('item')
        );
    }
}
