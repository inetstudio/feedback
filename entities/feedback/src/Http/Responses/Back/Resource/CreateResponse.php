<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\CreateResponseContract;

class CreateResponse implements CreateResponseContract
{
    public function __construct(
        protected ItemsServiceContract $resourceService
    ) {}

    public function toResponse($request)
    {
        $item = $this->resourceService->getItemById();

        return view(
            'admin.module.feedback::back.pages.form',
            compact('item')
        );
    }
}
