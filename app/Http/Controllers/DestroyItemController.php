<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\App;

class DestroyItemController extends Controller
{
    public function __invoke(Request $request, string $id)
    {
        $locale = $request->header('Accept-Language', 'en');
        App::setLocale($locale);

        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->delete();
            return response()->json(['message' => __('message.item_dels')]);
        }

        return response()->json(['message' => __('message.item_not_found')], 404);
    }
}

