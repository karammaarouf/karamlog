<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserSettingController;

Route::middleware(['auth'])->group(function () {

Route::get('/', function () {return view('layouts.app');})->name('home');

Route::resource('/users', UserController::class);
Route::get('/usersDeleted', [UserController::class, 'deleted'])->name('users.deleted');
Route::put('/users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');

Route::resource('/roles', RoleController::class);

Route::resource('/items', ItemController::class);
Route::get('/itemsdeleted', [ItemController::class, 'deleted'])->name('items.deleted');

Route::resource('/categories', CategoryController::class);
Route::get('/categoriesdeleted', [CategoryController::class, 'deleted'])->name('categories.deleted');
Route::put('/categories/{category}/toggle-active', [CategoryController::class, 'toggleActive'])->name('categories.toggleActive');
Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->withTrashed()->name('categories.restore');
Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->withTrashed()->name('categories.forceDelete');

// Settings page
Route::get('/settings', [UserSettingController::class, 'index'])->name('settings.index');
Route::put('/settings', [UserSettingController::class, 'update'])->name('settings.update');
Route::put('/settings/locale', [UserSettingController::class, 'setLocale'])->name('settings.setLocale');
Route::put('/settings/mode', [UserSettingController::class, 'setMode'])->name('settings.setMode');
Route::put('/settings/default', [UserSettingController::class, 'setDefault'])->name('settings.setDefault');

// Profile page
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


});
require __DIR__.'/auth.php';
