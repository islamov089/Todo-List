<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class IndexItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            $items = Item::orderBy('created_at', 'desc')->get();
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve items: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }
    }
}

