<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;


// Registrar el middleware directamente
Route::aliasMiddleware('role', CheckRole::class);
// Rutas de autenticación
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de recuperación de contraseña
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [UserController::class, 'edit'])->name('settings');
    Route::resource('users', UserController::class);
    Route::get('/archivos', [ArchivoController::class, 'index'])->name('archivos.index');
    Route::get('/archivos/create', [ArchivoController::class, 'create'])->name('archivos.create');
    Route::post('/archivos', [ArchivoController::class, 'store'])->name('archivos.store');
    Route::get('/destroy/{id}', [ArchivoController::class, 'destroy'])->name('archivos.destroy');
    Route::get('/show/{id}', [ArchivoController::class, 'show'])->name('archivos.show');
    Route::get('/edit/{id}', [ArchivoController::class, 'edit'])->name('archivos.edit');
Route::post('/settings', [UserController::class, 'update'])->name('settings.update');
});

