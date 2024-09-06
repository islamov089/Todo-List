<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImports;
use App\Models\Item;
use App\Http\Requests\ImportFileRequest;

class UploadController extends Controller
{
    public function upload(ImportFileRequest $request )
    {
       
        Excel::import(new ItemImports, $request->file('file'));

        return response()->json(['message' => 'File processed successfully'], 200);
    }
}
