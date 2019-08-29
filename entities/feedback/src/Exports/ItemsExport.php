<?php

namespace InetStudio\FeedbackPackage\Feedback\Exports;

use Illuminate\Database\Query\Builder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FeedbackPackage\Feedback\Contracts\Exports\ItemsExportContract;

/**
 * Class ItemsExport.
 */
class ItemsExport implements ItemsExportContract
{
    use Exportable;

    /**
     * Запрос на получение данных.
     *
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function query()
    {
        $model = app()->make('InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract');

        return $model::query();
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->email,
            $item->message,
            Date::dateTimeToExcel($item->created_at),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Имя',
            'Email',
            'Сообщение',
            'Время отправки',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
