<?php

namespace Modules\Item\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller; 

class UpdateItemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $existingItem = Item::findOrFail($id);

        $existingItem->name = $request->input('name');
        $existingItem->status = $request->input('status');
        $existingItem->deadline = $request->input('deadline') ? Carbon::parse($request->input('deadline')) : null;
        $existingItem->completed = $request->input('completed') ? true : false;
        $existingItem->completed_at = $request->input('completed') ? Carbon::now() : null;

        $existingItem->save();


        return response()->json($existingItem);
    }
}
