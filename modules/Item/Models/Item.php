<?php

// Modules/Item/Models/Item.php
namespace Modules\Item\Models;

use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Model;
use Modules\Item\StateMachines\ItemStatusStateMachine;

class Item extends Model
{
    use HasStateMachines;

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

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
