<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserSettingController;

Route::middleware(['auth'])->group(function () {

Route::get('/', function () {return view('layouts.app');})->name('home');

Route::resource('/users', UserController::class);
Route::get('/usersDeleted', [UserController::class, 'deleted'])->name('users.deleted');
Route::put('/usersRestoreAll', [UserController::class, 'restoreAll'])->name('users.restoreAll');
Route::delete('/usersForceDeleteAll', [UserController::class, 'forceDeleteAll'])->name('users.forceDeleteAll');
Route::put('/users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');

Route::resource('/roles', RoleController::class);

Route::resource('/items', ItemController::class);
Route::get('/itemsdeleted', [ItemController::class, 'deleted'])->name('items.deleted');
Route::put('/itemsRestoreAll', [ItemController::class, 'restoreAll'])->name('items.restoreAll');
Route::delete('/itemsForceDeleteAll', [ItemController::class, 'forceDeleteAll'])->name('items.forceDeleteAll');
Route::put('/items/{item}/restore', [ItemController::class, 'restore'])->withTrashed()->name('items.restore');
Route::delete('/items/{item}/force-delete', [ItemController::class, 'forceDelete'])->withTrashed()->name('items.forceDelete');
Route::put('/items/{item}/toggle-active', [ItemController::class, 'toggleActive'])->name('items.toggleActive');

Route::resource('/categories', CategoryController::class);
Route::get('/categoriesdeleted', [CategoryController::class, 'deleted'])->name('categories.deleted');
Route::put('/categoriesRestoreAll', [CategoryController::class, 'restoreAll'])->name('categories.restoreAll');
Route::delete('/categoriesForceDeleteAll', [CategoryController::class, 'forceDeleteAll'])->name('categories.forceDeleteAll');
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
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Group page
Route::resource('/groups',GroupController::class);
Route::get('/groupsdeleted', [GroupController::class, 'deleted'])->name('groups.deleted');
Route::put('/groupsRestoreAll', [GroupController::class, 'restoreAll'])->name('groups.restoreAll');
Route::delete('/groupsForceDeleteAll', [GroupController::class, 'forceDeleteAll'])->name('groups.forceDeleteAll');
Route::put('/groups/{group}/restore', [GroupController::class, 'restore'])->withTrashed()->name('groups.restore');
Route::delete('/groups/{group}/force-delete', [GroupController::class, 'forceDelete'])->withTrashed()->name('groups.forceDelete');
Route::put('/groups/{group}/toggle-active', [GroupController::class, 'toggleActive'])->name('groups.toggleActive');


});
require __DIR__.'/auth.php';
