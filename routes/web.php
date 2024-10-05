<?php

/**
 * @file
 */

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckNoteUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.update.picture');
});

Route::middleware(['auth', CheckNoteUser::class])->group(function () {
    Route::get('/note/{id}', [NoteController::class, 'show'])->name('note.show.single');
    Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/note', [NoteController::class, 'show'])->name('note.index');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
});

require __DIR__ . '/auth.php';
