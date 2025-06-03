<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('projects', ProjectController::class);

Route::apiResource('page', PageController::class);
