<?php

namespace Inetstudio\Feedback\Transformers;

use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;
use InetStudio\Feedback\Models\FeedbackModel;

class FeedbackTransformer extends TransformerAbstract
{
    /**
     * @param FeedbackModel $feedback
     * @return array
     */
    public function transform(FeedbackModel $feedback)
    {
        return [
            'id' => (int) $feedback->id,
            'status' => view('admin.module.feedback::partials.datatables.status', [
                'is_read' => $feedback->is_read,
            ])->render(),
            'name' => $feedback->name,
            'email' => $feedback->email,
            'message' => Str::limit($feedback->message, 100, '...'),
            'created_at' => (string) $feedback->created_at,
            'actions' => view('admin.module.feedback::partials.datatables.actions', [
                'id' => $feedback->id,
            ])->render(),
        ];
    }
}
