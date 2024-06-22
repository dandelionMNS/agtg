<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// User Related Routes
{
    Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user.index');
    Route::get('/users/add', [UserController::class, 'addPage'])->middleware(['auth', 'verified'])->name('user.addPage');
    Route::post('/users/added', [UserController::class, 'add'])->middleware(['auth', 'verified'])->name('user.add');

    // Route::get('/user/teachers', [UserController::class, 'listTeachers'])->middleware(['auth', 'verified'])->name('user.teacher');
    // Route::get('/user/students', [UserController::class, 'listStudents'])->middleware(['auth', 'verified'])->name('user.student');


    Route::get('/user/{id}', [UserController::class, 'userDetail'])->middleware(['auth', 'verified'])->name('user.details');
    Route::put('/user/{id}/update', [UserController::class, 'userUpdate'])->middleware(['auth', 'verified'])->name('user.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'userDelete'])->middleware(['auth', 'verified'])->name('user.delete');
}


require __DIR__.'/auth.php';
