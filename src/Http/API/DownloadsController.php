<?php

namespace InetStudio\Feedback\Http\Controllers\API;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Exports\FeedbackExport;

/**
 * Class DownloadsController.
 */
class DownloadsController extends Controller
{
    /**
     * Скачиваем сообщения обратной связи.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadMessages()
    {
        return Excel::download(new FeedbackExport, time().'.xlsx');
    }
}
