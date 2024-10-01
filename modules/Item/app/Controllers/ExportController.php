<?php


namespace Modules\Item\Controllers;

use App\Http\Controllers\Controller;
//use Maatwebsite\Excel\Facades\Excel;
use Modules\Item\Exports\ItemsExport;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ItemsExport, 'items.xlsx');

    }
}
