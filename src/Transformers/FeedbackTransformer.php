<?php

namespace InetStudio\Feedback\Transformers;

use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;
use InetStudio\Feedback\Models\FeedbackModel;

class FeedbackTransformer extends TransformerAbstract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param FeedbackModel $feedback
     * @return array
     */
    public function transform(FeedbackModel $feedback): array
    {
        return [
            'id' => (int) $feedback->id,
            'read' => view('admin.module.feedback::back.partials.datatables.read', [
                'is_read' => $feedback->is_read,
            ])->render(),
            'name' => $feedback->name,
            'email' => $feedback->email,
            'message' => Str::limit($feedback->message, 100, '...'),
            'created_at' => (string) $feedback->created_at,
            'actions' => view('admin.module.feedback::back.partials.datatables.actions', [
                'id' => $feedback->id,
            ])->render(),
        ];
    }
}
