<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Debug route - remove in production
Route::get('/debug/env', function () {
    if (!app()->environment('production')) {
        return response()->json([
            'APP_ENV' => env('APP_ENV'),
            'GOOGLE_CLIENT_ID_SET' => !empty(env('GOOGLE_CLIENT_ID')),
            'GOOGLE_CLIENT_SECRET_SET' => !empty(env('GOOGLE_CLIENT_SECRET')),
            'GOOGLE_REDIRECT_URI' => env('GOOGLE_REDIRECT_URI'),
        ]);
    }
    return abort(404);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth Routes
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

require __DIR__.'/auth.php';
