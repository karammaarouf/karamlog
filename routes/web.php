<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('/users', UserController::class);
Route::get('/usersdeleted', [UserController::class, 'deleted'])->name('users.deleted');

Route::resource('/items', ItemController::class);
Route::get('/itemsdeleted', [ItemController::class, 'deleted'])->name('items.deleted');
