<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WebTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [WebTaskController::class, 'index'])->name('tasks');


Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});