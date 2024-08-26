<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 
        'status', 
        'deadline', 
        'completed', 
        'completed_at'
    ];

    protected $casts = [
        'deadline' => 'date',
        'completed_at' => 'datetime',
    ];
}
