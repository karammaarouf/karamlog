<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth'])->group(function () {

Route::get('/', function () {return view('layouts.app');})->name('home');

// Locale switcher
Route::get('/locale/{locale}', function (string $locale) {
    if (!in_array($locale, ['ar', 'en'])) {
        abort(404);
    }
    session(['locale' => $locale]);
    return back();
})->name('locale.switch');

Route::resource('/users', UserController::class);
Route::get('/usersDeleted', [UserController::class, 'deleted'])->name('users.deleted');
Route::put('/users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');

Route::resource('/roles', RoleController::class);

Route::resource('/items', ItemController::class);
Route::get('/itemsdeleted', [ItemController::class, 'deleted'])->name('items.deleted');

Route::resource('/categories', CategoryController::class);
Route::put('/categories/{category}/toggle-active', [CategoryController::class, 'toggleActive'])->name('categories.toggleActive');
Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->withTrashed()->name('categories.restore');
Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->withTrashed()->name('categories.forceDelete');
});
require __DIR__.'/auth.php';
