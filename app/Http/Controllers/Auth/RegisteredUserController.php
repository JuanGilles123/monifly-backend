<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Goal;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $v = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'string', 'size:2'],
            'currency' => ['required', 'string', 'size:3'],
            'goal_name' => ['nullable', 'string', 'max:255'],
            'goal_target' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user = User::create([
            'name' => $v['name'],
            'email' => $v['email'],
            'password' => Hash::make($v['password']),
            'country' => $v['country'],
            'currency_preferred' => $v['currency'],
        ]);

        // Create initial goal if provided
        if (!empty($v['goal_name'])) {
            Goal::create([
                'user_id' => $user->id,
                'name' => $v['goal_name'],
                'target_cents' => (int) round(($v['goal_target'] ?? 0) * 100),
                'currency' => $v['currency'],
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
