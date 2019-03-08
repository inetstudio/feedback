<?php

namespace InetStudio\Feedback\Http\Responses\Back\Resource;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param FeedbackModelContract $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        return response()->redirectToRoute('back.feedback.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
