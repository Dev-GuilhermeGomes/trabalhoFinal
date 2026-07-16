<?php

use App\Http\Controllers\StudioController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::fallback([App\Http\Controllers\GameController::class, 'fallback'])->name('fallback');

// Público
Route::get('/', [StudioController::class, 'index'])->name('studios.index');
Route::redirect('/home', '/');
Route::get('/studios/{studio}/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::post('/games/{game}/reviews', [GameController::class, 'storeReview'])->name('games.reviews.store');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('studios', StudioController::class)->except(['index']);

    Route::get('/studios/{studio}/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/studios/{studio}/games', [GameController::class, 'store'])->name('games.store');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});