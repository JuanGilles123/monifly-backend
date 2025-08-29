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
            $googleUser = Socialite::driver('google')->user();
            
            Log::info('Google OAuth callback received', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId()
            ]);
            
            // Check if user already exists by email or google_id
            $existingUser = User::where('email', $googleUser->getEmail())
                              ->orWhere('google_id', $googleUser->getId())
                              ->first();
            
            if ($existingUser) {
                // Update Google ID if not set
                if (!$existingUser->google_id) {
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
                
                Auth::login($existingUser);
                Log::info('Existing user logged in via Google', ['user_id' => $existingUser->id]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Random password
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'country' => null,
                    'currency' => 'USD',
                    'email_verified_at' => now(), // Auto-verify Google users
                ]);
                
                Auth::login($user);
                Log::info('New user created and logged in via Google', ['user_id' => $user->id]);
            }
            
            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            Log::error('Google OAuth callback error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect('/login')->with('error', 'Unable to login with Google: ' . $e->getMessage());
        }
    }
}
