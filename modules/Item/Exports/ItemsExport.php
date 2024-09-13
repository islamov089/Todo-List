<?php


namespace Modules\Item\Exports;

use Modules\Item\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Item::all();
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
}
