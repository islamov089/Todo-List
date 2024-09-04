<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImports;
use App\Models\Item;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);

        $file = $request->file('file');

        $import = new ItemImports();
        Excel::import($import, $file);

        $items = $import->getItems();

        foreach ($items as $itemData) {
            Item::updateOrCreate(
                ['name' => $itemData['name']], 
                $itemData
            );
        }

        return response()->json(['message' => 'File processed successfully'], 200);
    }
}
