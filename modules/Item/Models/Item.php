<?php

namespace Modules\Item\Models;

use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Model;
use Modules\Item\StateMachines\ItemStatusStateMachine;

class Item extends Model
{
    use HasStateMachines;

    protected $fillable = [
        'name',
        'status',
        'deadline',
        'completed',
        'completed_at'
    ];

    public $stateMachines = [
        'status' => ItemStatusStateMachine::class
    ];
}
