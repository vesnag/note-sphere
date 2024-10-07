<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckNoteUser;
use Illuminate\Support\Facades\Route;

// Home Route.
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard Routes.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Note Routes.
Route::middleware(['auth'])->group(function () {
    Route::get('/notes', [NoteController::class, 'show'])->name('note.index');
    Route::post('/notes', [NoteController::class, 'store'])->name('note.store');
});

// Note Routes with CheckNoteUser Middleware.
Route::middleware(['auth', 'verified', CheckNoteUser::class])->group(function () {
    Route::get('/notes/{id}', [NoteController::class, 'show'])->name('note.show.single');
    Route::put('/notes/{id}', [NoteController::class, 'update'])->name('note.update');
});

// Profile Routes.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
});

require __DIR__ . '/auth.php';
