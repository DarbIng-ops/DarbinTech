<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PreRegistrationController as AdminPreRegistrationController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ClientProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

// Public
Route::get('/pre-registro', [PreRegistrationController::class, 'create'])->name('pre-registro');
Route::post('/pre-registro', [PreRegistrationController::class, 'store'])->name('pre-registro.store');

// Client
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects/{project}', [ClientProjectController::class, 'show'])->name('projects.show');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('projects', AdminProjectController::class);
    Route::get('/pre-registrations', [AdminPreRegistrationController::class, 'index'])->name('pre-registrations.index');
    Route::patch('/pre-registrations/{preRegistration}', [AdminPreRegistrationController::class, 'update'])->name('pre-registrations.update');
});

// Profile (any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->get('/acceder', fn () => view('acceder.index'))->name('acceder');

require __DIR__.'/auth.php';
