<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AllTaskController;

Route::view('/', 'home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('my-day', DashboardController::class)->name('my-day');
    Route::get('all-task', AllTaskController::class)->name('all-task');
    Route::get('completed-tasks', [\App\Http\Controllers\AllTaskController::class, 'completed'])->name('completed-tasks');
    Route::get('upcoming', [\App\Http\Controllers\DashboardController::class, 'upcoming'])->name('upcoming');
    Route::get('due', [\App\Http\Controllers\DashboardController::class, 'due'])->name('due');
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('overdue', [\App\Http\Controllers\DashboardController::class, 'overdue'])->name('overdue');
    Route::get('latest-notes', [\App\Http\Controllers\DashboardController::class, 'latestNotes'])->name('latest-notes');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/changepassword/{user}', [ProfileController::class, 'changepassword'])->name('profile.changepassword');
    Route::delete('/profile/delete/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('tasks/search', [\App\Http\Controllers\DashboardController::class, 'search'])->name('tasks.search');
Route::resource('lists', CategoryController::class);
Route::resource('lists.tasks', CategoryTaskController::class)->except('show', 'index');

Route::patch('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');


Route::resource('notes', \App\Http\Controllers\NotesController::class);
});
