<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

// Protected routes that require email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Add more protected routes here as needed
    // Route::resource('goals', GoalController::class);
    // Route::resource('transactions', TransactionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth Routes
Route::get('/auth/google/redirect', fn() => Socialite::driver('google')->redirect())->name('google.redirect');
Route::get('/auth/google/callback', function () {
    $g = Socialite::driver('google')->stateless()->user(); // importante en DO
    
    $user = User::where('email', $g->getEmail())->first();
    
    if ($user) {
        // Linkea Google si no estaba
        if (!$user->google_id) {
            $user->update([
                'google_id' => $g->getId(),
                'avatar_url' => $g->getAvatar(),
                'provider' => 'google',
                'provider_id' => $g->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        }
    } else {
        $user = User::create([
            'name' => $g->getName() ?: ($g->getNickname() ?: 'Usuario MoniFly'),
            'email' => $g->getEmail(),
            'password' => Hash::make(str()->random(32)),
            'google_id' => $g->getId(),
            'avatar_url' => $g->getAvatar(),
            'provider' => 'google',
            'provider_id' => $g->getId(),
            'email_verified_at' => now(),
            'currency_preferred' => 'USD',
        ]);
    }
    
    Auth::login($user, remember: true);
    return redirect()->intended('/dashboard');
});

require __DIR__.'/auth.php';
