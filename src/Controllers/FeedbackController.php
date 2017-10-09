<?php

namespace InetStudio\Feedback\Controllers;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\AdminPanel\Traits\DatatablesTrait;
use InetStudio\Feedback\Transformers\FeedbackTransformer;

/**
 * Контроллер для управления сообщений.
 *
 * Class ContestByTagStatusesController
 */
class FeedbackController extends Controller
{
    use DatatablesTrait;

    /**
     * Список сообщений.
     *
     * @param DataTables $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DataTables $dataTable)
    {
        $table = $this->generateTable($dataTable, 'feedback', 'index');

        return view('admin.module.feedback::pages.index', compact('table'));
    }

    /**
     * Datatables serverside.
     *
     * @return mixed
     */
    public function data()
    {
        $items = FeedbackModel::query();

        return DataTables::of($items)
            ->setTransformer(new FeedbackTransformer)
            ->rawColumns(['actions'])
            ->make();
    }
    
    /**
     * Редактирование сообщения.
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null)
    {
        if (! is_null($id) && $id > 0 && $item = FeedbackModel::find($id)) {
            $item->update([
                'is_read' => true,
            ]);
            
            return view('admin.module.feedback::pages.form', [
                'item' => $item,
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Удаление сообщения.
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null)
    {
        if (! is_null($id) && $id > 0 && $item = FeedbackModel::find($id)) {
            $item->delete();

            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
