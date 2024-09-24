<?php

namespace Modules\Item\Models;

use Iben\Statable\Statable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Statable;

    protected $fillable = [
        'name',
        'status',
        'deadline',
        'completed',
        'completed_at',
    ];

    protected $casts = [
        'deadline' => 'date',
        'completed_at' => 'datetime',
    ];

    protected function getGraph()
    {
        return 'item';
    }
}
