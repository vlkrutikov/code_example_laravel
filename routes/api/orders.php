<?php

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], static function () {
        //Route::group(['middleware' => 'auth:api'], static function () {
            Route::post('/', [\App\Http\Controllers\Api\OrdersController::class, 'add'])->name('add');
        //});
    });
