<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/classes', [ClassroomController::class, 'index'])->middleware(['auth', 'verified'])->name('classes');
Route::get('/classes/create', [ClassroomController::class, 'create'])->middleware(['auth', 'verified', 'can:teacher'])->name('create_class');
Route::post('/classes', [ClassroomController::class, 'store'])->middleware(['auth', 'verified', 'can:teacher']);


Route::get('/admin-panel', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'can:admin'])->name('admin-panel');
Route::post('/admin-panel', [AdminController::class, 'updateRole'])->middleware(['auth', 'verified', 'can:admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
