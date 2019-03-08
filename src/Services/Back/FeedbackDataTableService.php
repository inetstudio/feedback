<?php

namespace InetStudio\Feedback\Services\Back;

use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use InetStudio\Feedback\Contracts\Services\Back\FeedbackDataTableServiceContract;

/**
 * Class FeedbackDataTableService.
 */
class FeedbackDataTableService extends DataTable implements FeedbackDataTableServiceContract
{
    /**
     * @var mixed FeedbackModelContract
     */
    public $model;

    /**
     * FeedbackDataTableService constructor.
     */
    public function __construct()
    {
        $this->model = app()->make('InetStudio\Feedback\Contracts\Models\FeedbackModelContract');
    }

    /**
     * Получение данных таблицы.
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function ajax(): JsonResponse
    {
        $transformer = app()->make('InetStudio\Feedback\Contracts\Transformers\Back\FeedbackTransformerContract');

        return DataTables::of($this->query())
            ->setTransformer($transformer)
            ->rawColumns(['checkbox', 'read', 'active', 'material', 'actions'])
            ->make();
    }

    /**
     * Получаем запрос для получения данных.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = $this->model->buildQuery([
            'columns' => ['created_at'],
        ]);

        return $query;
    }

    /**
     * Генерация таблицы.
     *
     * @return Builder
     *
     * @throws \Throwable
     */
    public function html(): Builder
    {
        $table = app('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    /**
     * Получаем колонки.
     *
     * @return array
     *
     * @throws \Throwable
     */
    protected function getColumns(): array
    {
        return [
            ['data' => 'checkbox', 'name' => 'checkbox', 'title' => view('admin.module.feedback::back.partials.datatables.checkbox')
                ->render(), 'orderable' => false, 'searchable' => false],
            ['data' => 'read', 'name' => 'is_read', 'title' => 'Прочитано', 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Имя'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'message', 'name' => 'message', 'title' => 'Сообщение'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Свойства ajax datatables.
     *
     * @return array
     */
    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.feedback.data.index'),
            'type' => 'POST',
        ];
    }

    /**
     * Свойства datatables.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $i18n = trans('admin::datatables');

        return [
            'order' => [
                5,
                'desc',
            ],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $i18n,
        ];
    }
}
