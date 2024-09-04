<?php

namespace App\Services\Upload;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImports;

class UploadService
{
    public function importItems($file)
    {
        $import = new ItemImports();
        Excel::import($import, $file);
        return $import->getItems();
    }
}
