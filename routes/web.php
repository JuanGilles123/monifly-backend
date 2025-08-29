<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
	return auth()->check() ? redirect()->route('dashboard') : view('landing');
})->name('home');

Route::middleware(['auth','verified'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth (usa controlador dedicado)
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

require __DIR__.'/auth.php';

// Ruta temporal de depuración de sesión (eliminar luego)
Route::get('/debug/session', function() { 
	return [
		'auth' => auth()->check(),
		'user_id' => auth()->id(),
		'session_id' => session()->getId(),
		'cookies' => request()->cookies->all(),
	];
})->middleware('web');