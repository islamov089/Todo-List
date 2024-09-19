<?php

namespace Modules\Item\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Item\Models\Item;

class ItemImports implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($this->rowGenerator($rows) as $row) {
            Item::updateOrCreate(
                ['name' => $row['name']], 
                [
                    'status' => $row['status'],
                    'deadline' => $this->convertToDate($row['deadline']),
                    'completed' => (bool)$row['completed'], 
                    'completed_at' => $this->convertToDate($row['completed_at']),
                ]
            );
        }
    }

    private function rowGenerator($rows)
    {
        foreach ($rows as $row) {
            yield [
                'name' => trim($row['name']), 
                'status' => trim($row['status']),
                'deadline' => trim($row['deadline']),
                'completed' => trim($row['completed']) ?? null, 
                'completed_at' => trim($row['completed_at']) ?? null, 
            ];
        }
    }

    private function convertToDate($value)
    {
        if (is_numeric($value)) {
            $date = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                          ->addDays($value - 2);
            return $date->format('Y-m-d');
        }

        try {
            $date = Carbon::parse($value);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null; 
        }
    }
}
