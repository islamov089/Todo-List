<?php

namespace App\Http\Controllers;

use App\Models\Item;

class DestroyItemController extends Controller
{
    
    public function destroy(string $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->delete();
            return response()->json(['message' => 'Item deleted successfully']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}
