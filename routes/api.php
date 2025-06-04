<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StackController;

use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::apiResource('project', ProjectController::class);

    Route::apiResource('page', PageController::class);

    Route::apiResource('social', SocialController::class);

    Route::apiResource('stack', StackController::class);
});
