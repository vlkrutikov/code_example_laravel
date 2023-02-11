<?php

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function () {
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('set-password', [\App\Http\Controllers\Api\AuthController::class, 'set-password']);
});
