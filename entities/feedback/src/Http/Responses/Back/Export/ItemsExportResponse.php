<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Responses\Back\Export;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use InetStudio\FeedbackPackage\Feedback\Contracts\Exports\ItemsExportContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Class ItemsExportResponse.
 */
class ItemsExportResponse implements ItemsExportResponseContract
{
    /**
     * @var ItemsExportContract
     */
    protected $export;

    /**
     * ItemsExportResponse constructor.
     *
     * @param  ItemsExportContract  $export
     */
    public function __construct(ItemsExportContract $export)
    {
        $this->export = $export;
    }

    /**
     * Экспорт данных.
     *
     * @param  Request  $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return Excel::download($this->export, time().'.xlsx');
    }
}
