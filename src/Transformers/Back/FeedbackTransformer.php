<?php

namespace InetStudio\Feedback\Transformers\Back;

use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;
use InetStudio\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\Feedback\Contracts\Transformers\Back\FeedbackTransformerContract;

/**
 * Class FeedbackTransformer.
 */
class FeedbackTransformer extends TransformerAbstract implements FeedbackTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param FeedbackModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(FeedbackModelContract $item): array
    {
        return [
            'checkbox' => view('admin.module.feedback::back.partials.datatables.checkbox', [
                'id' => $item->id,
            ])->render(),
            'id' => (int) $item->id,
            'read' => view('admin.module.feedback::back.partials.datatables.read', [
                'is_read' => $item->is_read,
            ])->render(),
            'name' => $item->name,
            'email' => $item->email,
            'message' => Str::limit($item->message, 100, '...'),
            'created_at' => (string) $item->created_at,
            'actions' => view('admin.module.feedback::back.partials.datatables.actions', [
                'id' => $item->id,
            ])->render(),
        ];
    }
}
