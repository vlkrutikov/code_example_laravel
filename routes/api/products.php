<?php

    Route::group(['prefix' => 'products', 'as' => 'products.'], static function () {
        Route::get('/', [\App\Http\Controllers\Api\ProductsController::class, 'search'])->name('search');
        Route::get('/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'view'])->name('view');
    });
