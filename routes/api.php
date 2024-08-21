<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreItemController;
use App\Http\Controllers\UpdateItemController;
use App\Http\Controllers\DestroyItemController;
use App\Http\Controllers\IndexItemController;

Route::prefix('item')->group(function () {
    Route::post('/store', [StoreItemController::class, 'store']);
    Route::put('/{id}', [UpdateItemController::class, 'update']);
    Route::delete('/{id}', [DestroyItemController::class, 'destroy']);
});

Route::get('/items', [IndexItemController::class, 'index']);

