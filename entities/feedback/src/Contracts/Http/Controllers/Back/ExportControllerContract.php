<?php

namespace InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Interface ExportControllerContract.
 */
interface ExportControllerContract
{
    /**
     * Экспорт объектов.
     *
     * @param  Request  $request
     * @param  ItemsExportResponseContract  $response
     *
     * @return ItemsExportResponseContract
     */
    public function exportItems(Request $request, ItemsExportResponseContract $response): ItemsExportResponseContract;
}
