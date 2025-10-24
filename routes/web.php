<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('/users', UserController::class);
Route::resource('/items', ItemController::class);
