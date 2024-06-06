<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentFormController;
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
});

Route::get('/index', [StudentFormController::class, 'index'])->name('student.index');
Route::get('/create', [StudentFormController::class, 'create'])->name('student.create');
Route::post('/store', [StudentFormController::class, 'store'])->name('student.store');
Route::get('/edit/{id}', [StudentFormController::class, 'edit'])->name('student.edit');
Route::post('/update', [StudentFormController::class, 'update'])->name('student.update');
Route::post('/delete', [StudentFormController::class, 'destroy'])->name('student.delete');

require __DIR__.'/auth.php';
