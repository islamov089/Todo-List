<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class UpdateItemController extends Controller
{
    
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();

            return response()->json($existingItem);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}
