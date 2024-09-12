<?php

namespace Modules\Item\Controllers;


namespace Modules\Item\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Item\Imports\ItemImports;
use Modules\Item\Requests\ImportFileRequest;

class UploadController extends Controller
{
    public function upload(ImportFileRequest $request)
    {
        Excel::import(new ItemImports, $request->file('file'));
        return response()->json(['message' => 'File processed successfully'], 200);
    }
}
