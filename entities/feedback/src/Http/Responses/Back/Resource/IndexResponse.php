<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Resource;

use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Services\Back\DataTables\IndexServiceContract as DataTableServiceContract;

class IndexResponse implements IndexResponseContract
{
    public function __construct(
        protected DataTableServiceContract $datatableService
    ) {}

    public function toResponse($request)
    {
        $table = $this->datatableService->html();

        return view(
            'admin.module.feedback::back.pages.index',
            compact('table')
        );
    }
}
