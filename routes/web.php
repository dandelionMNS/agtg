<?php

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DutyController;
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

    Route::get('/user/{id}', [UserController::class, 'userDetail'])->middleware(['auth', 'verified'])->name('user.details');
    Route::put('/user/{id}/update', [UserController::class, 'userUpdate'])->middleware(['auth', 'verified'])->name('user.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'userDelete'])->middleware(['auth', 'verified'])->name('user.delete');
}

// Leave Related Routes
{
    Route::get('/leave', [LeaveController::class, 'index'])->middleware(['auth', 'verified'])->name('leave.index');
    Route::get('/leave/add', [LeaveController::class, 'addPage'])->middleware(['auth', 'verified'])->name('leave.addPage');
    Route::post('/leave/added', [LeaveController::class, 'add'])->middleware(['auth', 'verified'])->name('leave.add');
    Route::get('/leave/{id}', [LeaveController::class, 'details'])->middleware(['auth', 'verified'])->name('leave.details');
    Route::put('/leave/{id}/update', [LeaveController::class, 'update'])->middleware(['auth', 'verified'])->name('leave.update');
    Route::delete('/leave/{id}/delete', [LeaveController::class, 'delete'])->middleware(['auth', 'verified'])->name('leave.delete');
}

// Leave Related Routes
{
    Route::get('/duty', [DutyController::class, 'index'])->middleware(['auth', 'verified'])->name('duty.index');
    Route::get('/duty/{date}', [DutyController::class, 'goToDate'])->middleware(['auth', 'verified'])->name('duty.goto');
    Route::get('/duty/{date}/add', [DutyController::class, 'addPage'])->middleware(['auth', 'verified'])->name('duty.addPage');
    Route::post('/duty/{date}/added', [DutyController::class, 'add'])->middleware(['auth', 'verified'])->name('duty.add');

    Route::put('/duty/clock-in/{duty_id}', [DutyController::class, 'clock_in'])->middleware(['auth', 'verified'])->name('duty.clockin');
    Route::put('/duty/clock-out/{duty_id}', [DutyController::class, 'clock_out'])->middleware(['auth', 'verified'])->name('duty.clockout');
    Route::delete('/duty/{id}/delete', [DutyController::class, 'delete'])->middleware(['auth', 'verified'])->name('duty.delete');
}


require __DIR__ . '/auth.php';
