<?php

namespace Modules\Item\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Modules\Item\Models\Item;

class UpdateItemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $existingItem = Item::findOrFail($id);

        $existingItem->name = $request->input('name');
        $existingItem->deadline = $request->input('deadline') ? Carbon::parse($request->input('deadline')) : null;
        $existingItem->completed = $request->input('completed') ? true : false;
        $existingItem->completed_at = $request->input('completed') ? Carbon::now() : null;

        $newStatus = $request->input('status');
        if ($newStatus) {
            try {
                $currentStatus = $existingItem->status;

                $existingItem->status()->transitionTo($newStatus);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }

        $existingItem->save();

        return response()->json($existingItem);
    }
}
