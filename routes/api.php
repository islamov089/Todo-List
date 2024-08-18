<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::prefix('item')->group(function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

Route::get('/items', [ItemController::class, 'index']);
