<?php

namespace Modules\Item\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class ItemStatusStateMachine extends StateMachine
{
    public function transitions(): array
    {
        return [
            'draft' => ['pending'],
            'pending' => ['in_progress'],
            'in_progress' => ['done'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'draft';
    }

    public function recordHistory(): bool
    {
        return true;
    }
}
