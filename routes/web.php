<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

// Google OAuth Routes
Route::get('/auth/google/redirect', fn() => Socialite::driver('google')->redirect());
Route::get('/auth/google/callback', function () {
    $g = Socialite::driver('google')->stateless()->user(); // stateless por proxy
    $user = User::firstOrCreate(
        ['email' => $g->getEmail()],
        ['name' => $g->getName() ?: $g->getNickname() ?: 'Usuario MoniFly', 'password' => bcrypt(str()->random(24))]
    );
    // guarda avatar si quieres: $g->getAvatar()
    Auth::login($user, remember: true);
    return redirect()->intended('/dashboard');
});

require __DIR__.'/auth.php';
