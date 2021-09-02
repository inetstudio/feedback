<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Front;

use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Front\SendItemResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Front\ItemsServiceContract as FeedbackServiceContract;

class SendItemResponse implements SendItemResponseContract
{
    public function __construct(
        protected FeedbackServiceContract $feedbackService
    ) {}

    public function toResponse($request)
    {
        $data = $request->all();
        $item = $this->feedbackService->save($data);

        $result = ($item && isset($item->id));

        return response()->json(
            [
                'success' => $result,
                'message' => ($result)
                    ? trans('feedback::messages.send_success')
                    : trans('feedback::messages.send_fail'),
            ]
        );
    }
}
