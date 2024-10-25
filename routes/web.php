<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;



Auth::routes();

Route::middleware('auth')->group(function () {

Route::get('/', function () {
    return view('tasks.index');
});

Route::get('/{any}', function () {
    return view('tasks.index');
})->where('any', '.*');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

