<?php

namespace InetStudio\Feedback\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use InetStudio\Feedback\Contracts\Exports\FeedbackExportContract;

/**
 * Class FeedbackExport.
 */
class FeedbackExport implements FeedbackExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        $model = app()->make('InetStudio\Feedback\Contracts\Models\FeedbackModelContract');

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
