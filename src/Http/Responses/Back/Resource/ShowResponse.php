<?php

namespace InetStudio\Feedback\Http\Responses\Back\Resource;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract, Responsable
{
    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * ShowResponse constructor.
     *
     * @param FeedbackModelContract $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->item);
    }
}
