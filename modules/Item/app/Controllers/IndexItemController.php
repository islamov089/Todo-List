<?php

namespace Modules\Item\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Item\Models\Item;


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

