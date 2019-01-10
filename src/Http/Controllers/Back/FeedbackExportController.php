<?php

namespace InetStudio\Feedback\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Contracts\Http\Controllers\Back\FeedbackExportControllerContract;

/**
 * Class FeedbackExportController.
 */
class FeedbackExportController extends Controller implements FeedbackExportControllerContract
{
    /**
     * Скачиваем сообщения обратной связи.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportFeedback()
    {
        $export = app()->makeWith('InetStudio\Feedback\Contracts\Exports\FeedbackExportContract');

        return Excel::download($export, time().'.xlsx');
    }
}
