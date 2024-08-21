<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreItemController;
use App\Http\Controllers\UpdateItemController;
use App\Http\Controllers\DestroyItemController;
use App\Http\Controllers\IndexItemController;

Route::prefix('item')->group(function () {
    Route::post('/store', StoreItemController::class);
    Route::put('/{id}', UpdateItemController::class);
    Route::delete('/{id}', DestroyItemController::class);
});

Route::get('/items', IndexItemController::class);

