<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('layouts.app');
});

// Locale switcher
Route::get('/locale/{locale}', function (string $locale) {
    if (!in_array($locale, ['ar', 'en'])) {
        abort(404);
    }
    session(['locale' => $locale]);
    return back();
})->name('locale.switch');

Route::resource('/users', UserController::class);
Route::get('/usersdeleted', [UserController::class, 'deleted'])->name('users.deleted');
Route::put('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

Route::resource('/items', ItemController::class);
Route::get('/itemsdeleted', [ItemController::class, 'deleted'])->name('items.deleted');

