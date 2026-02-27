<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class);
    Route::resource('authors',  AuthorController::class);
    Route::resource('books',    BookController::class);
    Route::resource('borrows',  BorrowController::class);

    // Return routes (partial or full)
    Route::get('borrows/{borrow}/return',  [BorrowController::class, 'returnForm'])->name('borrows.return');
    Route::post('borrows/{borrow}/return', [BorrowController::class, 'processReturn'])->name('borrows.process-return');
});

require __DIR__.'/auth.php';
