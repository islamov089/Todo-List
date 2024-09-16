<?php

namespace Modules\Item\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Item\Models\Item;

class ItemImports implements ToCollection
{
    use Importable;

    public function collection(Collection $rows)
    {
        $rows->shift(); 

        foreach ($this->rowGenerator($rows) as $row) {
            Item::updateOrCreate(
                ['name' => trim($row['name'])], 
                [
                    'status' => trim($row['status']),
                    'deadline' => $this->convertToDate(trim($row['deadline'])),
                    'completed' => isset($row['completed']) ? (bool)trim($row['completed']) : false,
                    'completed_at' => isset($row['completed_at']) ? $this->convertToDate(trim($row['completed_at'])) : null,
                ]
            );
        }
    }

    private function rowGenerator($rows)
    {
        foreach ($rows as $row) {
            yield [
                'name' => $row[0],
                'status' => $row[1],
                'deadline' => $row[2],
                'completed' => $row[3] ?? null,
                'completed_at' => $row[4] ?? null,
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
