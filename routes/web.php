<?php

use App\Http\Controllers\StackController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\SocialController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('project', ProjectController::class);

Route::apiResource('page', PageController::class);

Route::apiResource('social', SocialController::class);

Route::apiResource('stack', StackController::class);
