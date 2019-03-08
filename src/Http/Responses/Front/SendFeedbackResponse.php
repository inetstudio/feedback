<?php

namespace InetStudio\Feedback\Http\Responses\Front;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Feedback\Contracts\Http\Responses\Front\SendFeedbackResponseContract;

/**
 * Class SendFeedbackResponse.
 */
class SendFeedbackResponse implements SendFeedbackResponseContract, Responsable
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * SendFeedbackResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при отправке сообщения.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'success' => $this->result,
            'message' => ($this->result)
                ? trans('feedback::messages.send_success')
                : trans('feedback::messages.send_fail'),
        ]);
    }
}
