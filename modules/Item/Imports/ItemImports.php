<?php

namespace modules\Item\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class ItemImports implements ToCollection
{
    use Importable;

    private $items = [];

    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {
            $this->items[] = [
                'name' => trim($row[0]),
                'status' => trim($row[1]),
                'deadline' => $this->convertToDate(trim($row[2])),
                'completed' => isset($row[3]) ? (bool)trim($row[3]) : false,
                'completed_at' => isset($row[4]) ? $this->convertToDate(trim($row[4])) : null,
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

    public function getItems()
    {
        return $this->items;
    }
}
