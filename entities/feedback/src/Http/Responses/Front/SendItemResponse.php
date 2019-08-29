<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Front;

use InetStudio\AdminPanel\Base\Http\Responses\BaseResponse;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Front\SendItemResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Front\ItemsServiceContract as FeedbackServiceContract;

/**
 * Class SendItemResponse.
 */
class SendItemResponse extends BaseResponse implements SendItemResponseContract
{
    /**
     * @var FeedbackServiceContract
     */
    protected $feedbackService;

    /**
     * SendItemResponse constructor.
     *
     * @param  FeedbackServiceContract  $feedbackService
     */
    public function __construct(FeedbackServiceContract $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * Prepare response data.
     *
     * @param $request
     *
     * @return array
     */
    protected function prepare($request): array
    {
        $data = $request->all();
        $item = $this->feedbackService->save($data);

        $result = ($item && isset($item->id));

        return [
            'success' => $result,
            'message' => ($result)
                ? trans('feedback::messages.send_success')
                : trans('feedback::messages.send_fail'),
        ];
    }
}
