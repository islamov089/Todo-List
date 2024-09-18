<?php

namespace Modules\Item\Exports;

use Modules\Item\Models\Item;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

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
