<?php

namespace InetStudio\FeedbackPackage\Feedback\Transformers\Back\Resource;

use Throwable;
use Illuminate\Support\Str;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends BaseTransformer implements IndexTransformerContract
{
    /**
     * Трансформация данных для отображения в таблице.
     *
     * @param  FeedbackModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(FeedbackModelContract $item): array
    {
        return [
            'checkbox' => view(
                'admin.module.feedback::back.partials.datatables.checkbox',
                [
                    'id' => $item['id'],
                ]
            )->render(),
            'id' => (int) $item['id'],
            'read' => view(
                'admin.module.feedback::back.partials.datatables.read',
                [
                    'is_read' => $item['is_read'],
                ]
            )->render(),
            'response' => view(
                'admin.module.feedback::back.partials.datatables.response',
                [
                    'response' => $item['response'],
                ]
            )->render(),
            'name' => $item['name'],
            'email' => $item['email'],
            'phone' => $item['phone'],
            'message' => Str::limit($item['message'], 100, '...'),
            'created_at' => (string) $item['created_at'],
            'material' => view(
                'admin.module.feedback::back.partials.datatables.material',
                [
                    'item' => $item['feedbackable'],
                ]
            )->render(),
            'actions' => view(
                'admin.module.feedback::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                ]
            )->render(),
        ];
    }
}
