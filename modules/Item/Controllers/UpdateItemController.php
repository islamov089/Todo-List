<?php

namespace Modules\Item\Controllers;

use Modules\Item\Requests\UpdateItemRequest;
use App\Http\Controllers\Controller;
use Modules\Item\Models\Item;
use Modules\Item\Actions\UpdateItemAction;

class UpdateItemController extends Controller
{
    protected $updateItemAction;

    public function __construct(UpdateItemAction $updateItemAction)
    {
        $this->updateItemAction = $updateItemAction;
    }

    public function __invoke(UpdateItemRequest $request, $id)
    {
        $existingItem = Item::findOrFail($id);

        try {
            $updatedItem = $this->updateItemAction->execute($existingItem, $request->validated());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json($updatedItem);
    }
}