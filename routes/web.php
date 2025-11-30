<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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
});
require __DIR__.'/auth.php';
