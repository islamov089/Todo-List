<?php

namespace Modules\Item\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Modules\Item\Models\Item;


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

