<?php

use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user());

Route::apiResource('videos', VideoController::class)->middleware('auth:sanctum');
