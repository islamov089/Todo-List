<?php

namespace Modules\Item\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Item\Controllers\StoreItemController;
use Modules\Item\Controllers\UpdateItemController;
use Modules\Item\Controllers\DestroyItemController;
use Modules\Item\Controllers\IndexItemController;
use Modules\Item\Controllers\UploadController;

Route::middleware('api')->prefix('api')->group(function(){
    Route::prefix('item')->group(function () {
        Route::post('/store', StoreItemController::class)->name('item.store');
        Route::put('/{id}', UpdateItemController::class)->name('item.update');
        Route::delete('/{id}', DestroyItemController::class)->name('item.destroy');
    });
    
    Route::get('/items', IndexItemController::class)->name('item.index');

});

// Route::get('/upload', UploadController::class)->name('item.upload');
