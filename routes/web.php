<?php

use App\Http\Controllers\WebTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [WebTaskController::class, 'index']);
