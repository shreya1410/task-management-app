<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

//  Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('tasks', TaskController::class);
    Route::as("tasks.")->prefix("tasks")->group(function (){
        Route::get('/{id}',[TaskController::class,'edit'])->name('edit');
    });
// });


