<?php

namespace Modules\Item\Controllers;

use Modules\Item\Requests\StoreItemRequest;
use App\Http\Controllers\Controller;
use Modules\Item\Models\Item;

class StoreItemController extends Controller
{
    public function __invoke(StoreItemRequest $request)
    {
        $data = $request->validated();

        $newItem = Item::create($data);
        return response()->json($newItem, 201);
    }
}
