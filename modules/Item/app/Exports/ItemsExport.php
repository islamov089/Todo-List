<?php

namespace Modules\Item\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Item\Models\Item;

class ItemsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithBatchInserts
{
    public function query()
    {
        return Item::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Status',
            'Deadline',
            'Completed',
            'Completed At',
            'Created At',
            'Updated At',
        ];
    }

    public function batchSize(): int
    {
        return 5;
    }
}
