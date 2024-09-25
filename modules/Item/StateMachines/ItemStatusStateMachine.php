<?php

namespace Modules\Item\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;
use Modules\Item\Models\Item;

class ItemStatusStateMachine extends StateMachine
{
    public function transitions(): array
    {
        return [
            Item::STATUS_DRAFT => [Item::STATUS_PENDING],
            Item::STATUS_PENDING => [Item::STATUS_IN_PROGRESS],
            Item::STATUS_IN_PROGRESS => [Item::STATUS_DONE],
        ];
    }

    public function defaultState(): ?string
    {
        return Item::STATUS_DRAFT;
    }

    public function recordHistory(): bool
    {
        return true;
    }
}
