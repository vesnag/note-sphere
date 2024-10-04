<?php

/**
 * @file
 */

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/note/{id?}', [NoteController::class, 'show'])->name('note.show');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
});

require __DIR__ . '/auth.php';
