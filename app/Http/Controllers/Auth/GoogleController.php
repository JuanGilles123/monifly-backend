<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function callback()
    {
        try {
            // Obtener usuario de Google (stateless para evitar problemas de "Invalid state")
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Si ya hay sesión activa, ir directo
            if (auth()->check()) {
                return redirect('/dashboard');
            }
            
            // Check if user exists by email
            $existingUser = User::where('email', $googleUser->getEmail())->first();
            
            if ($existingUser) {
                // Login existing user
                Auth::login($existingUser);
            } else {
                // Create new user with basic required fields only
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                ]);
                
                Auth::login($user);
            }
            
            // Force redirect to dashboard
            return redirect('/dashboard');
            
        } catch (\Exception $e) {
            // Log the actual error and redirect with message
            \Log::error('Google OAuth Error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return redirect('/login')->withErrors(['google' => 'Error con Google: '.$e->getMessage()]);
        }
    }
}
