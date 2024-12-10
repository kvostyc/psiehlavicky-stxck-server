<?php

use App\Http\Controllers\Api\Frontend\V1\Order\FrontendOrderController;
use App\Http\Controllers\Api\Remote\V1\Order\RemoteOrderController;
use App\Http\Controllers\Api\Remote\V1\Order\RemoteOrderItemController;
use App\Http\Controllers\Api\Remote\V1\Order\RemoteOrderItemStateController;
use Illuminate\Support\Facades\Route;

Route::prefix('remote')
    ->middleware("api.remote.verifyapikey")
    ->group(function () {
        Route::prefix('v1')->group(function () {
            Route::apiResource('orders', RemoteOrderController::class);
            Route::apiResource('order-items', RemoteOrderItemController::class);
            Route::apiResource('order-item-states', RemoteOrderItemStateController::class)->only("index");
        });
    });

Route::prefix('frontend')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::apiResource('orders', FrontendOrderController::class);
    });
});
