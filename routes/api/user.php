<?php

Route::group(['prefix' => 'user', 'as' => 'user.'], static function () {
    Route::post('/', 'RegistrationController')->name('create');
});
