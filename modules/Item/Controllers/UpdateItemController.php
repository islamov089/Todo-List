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
        try {
            $existingItem = Item::findOrFail($id);

            $existingItem->name = $request->input('name', $existingItem->name);
            $existingItem->deadline = $request->input('deadline') ? Carbon::parse($request->input('deadline')) : $existingItem->deadline;
            $existingItem->completed = $request->input('completed') ? true : false;
            $existingItem->completed_at = $request->input('completed') ? Carbon::now() : $existingItem->completed_at;

            $newStatus = $request->input('status');

            if ($newStatus) {
                if ($newStatus === 'done' && $existingItem->status === 'in_progress') {
                    if ($existingItem->canApply('complete')) {
                        $existingItem->apply('complete');
                    } else {
                        return response()->json(['error' => 'Cannot transition to this status'], 400);
                    }
                } elseif ($newStatus === 'in_progress' && $existingItem->status === 'pending') {
                    if ($existingItem->canApply('start_in_progress')) {
                        $existingItem->apply('start_in_progress');
                    } else {
                        return response()->json(['error' => 'Cannot transition to this status'], 400);
                    }
                } elseif (in_array($newStatus, ['draft', 'pending', 'in_progress'])) {
                    if ($existingItem->status !== $newStatus && $existingItem->canApply($newStatus)) {
                        $existingItem->apply($newStatus);
                    } else {
                        return response()->json(['error' => 'Invalid status or transition'], 400);
                    }
                } else {
                    return response()->json(['error' => 'Invalid status'], 400);
                }
            }

            $existingItem->save();

            return response()->json($existingItem);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
