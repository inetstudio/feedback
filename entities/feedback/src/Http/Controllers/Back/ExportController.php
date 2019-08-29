<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Controllers\Back\ExportControllerContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Class ExportController.
 */
class ExportController extends Controller implements ExportControllerContract
{
    /**
     * Экспорт объектов.
     *
     * @param  Request  $request
     * @param  ItemsExportResponseContract  $response
     *
     * @return ItemsExportResponseContract
     */
    public function exportItems(Request $request, ItemsExportResponseContract $response): ItemsExportResponseContract
    {
        return $response;
    }
}
