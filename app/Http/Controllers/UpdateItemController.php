<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class UpdateItemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->name = $request->input('name');
            $existingItem->status = $request->input('status');
            $existingItem->deadline = $request->input('deadline');
            $existingItem->completed = $request->input('completed') ? true : false;
            $existingItem->completed_at = $request->input('completed') ? Carbon::now() : null;
            $existingItem->save();

            return response()->json($existingItem);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}
