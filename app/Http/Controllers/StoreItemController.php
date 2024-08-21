<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class StoreItemController extends Controller
{
    
    public function __invoke(Request $request)
    {
        $data = $request->input('item');
        $newItem = new Item();
        $newItem->name = $data['name'];
        $newItem->save();
        
        return response()->json($newItem, 201);
    }
}
