<?php

namespace Modules\Item\Controllers;

use App\Models\Item;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 


class IndexItemController extends Controller
{
    
    public function __invoke()
    {
        try {
            $items = Item::orderByDesc('created_at')->get();
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve items: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }
    }
}

