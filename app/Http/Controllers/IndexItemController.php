<?php

namespace App\Http\Controllers;

use App\Models\Item;

class IndexItemController extends Controller
{
   
    public function index()
    {
        return Item::orderBy('created_at', 'Desc')->get();
    }
}
