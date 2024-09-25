<?php

namespace Modules\Item\Actions;

use Illuminate\Support\Carbon;
use Modules\Item\Models\Item;

class UpdateItemAction
{
    public function execute(Item $item, array $data)
    {
        $item->name = $data['name'];
        $item->deadline = isset($data['deadline']) ? Carbon::parse($data['deadline']) : null;
        $item->completed = isset($data['completed']) ? true : false;
        $item->completed_at = isset($data['completed']) ? Carbon::now() : null;

        $newStatus = $data['status'] ?? null;

        if ($newStatus) {
            try {
                $item->status()->transitionTo($newStatus);
                $item->save();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        

        return $item;
    }
}
