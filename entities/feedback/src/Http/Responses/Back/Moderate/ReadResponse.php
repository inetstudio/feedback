<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Moderate;

use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;

class ReadResponse implements ReadResponseContract
{
    public function __construct(
        protected ModerateServiceContract $moderateService
    ) {}

    public function toResponse($request)
    {
        $ids = $request->get('feedback') ?? [];

        $result = $this->moderateService->updateRead($ids);

        return response()->json(
            [
                'success' => $result,
            ]
        );
    }
}
