<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('auth/me', [ApiController::class, 'user'])->name('user');

    Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
        Route::get('{key}', [ApiController::class, 'offers'])->name('offers');
    });

    Route::get('sync/{target}', [ApiController::class, 'sync'])->name('sync');
});

Route::post('v1/auth/token', [ApiController::class, 'authToken'])->name('token');
