@php
    if(auth()->check()) {
        header('Location: '.route('dashboard')); exit; // redirect early if already authenticated
    }
@endphp
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-0">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

    <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-6">
            <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-white text-gray-900 font-medium border border-gray-300 hover:bg-gray-100 transition text-sm">
                <svg width="16" height="16" viewBox="0 0 533.5 544.3"><path fill="#4285f4" d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h146.9c-6.2 33.8-25.6 63.6-54.4 82.7v68h87.7c51.3-47.2 81.2-116.7 81.2-200.2z"/><path fill="#34a853" d="M272.1 544.3c73.5 0 135.3-24.3 180.4-65.7l-87.7-68c-24.4 16.6-55.8 26-92.6 26-71 0-131.2-47.9-152.8-112.2H28.9v70.4c46.2 91.9 141.2 149.5 243.2 149.5z"/><path fill="#fbbc04" d="M119.3 324.4c-10.2-30.3-10.2-63.6 0-93.9V160.1H28.9c-38.6 76.7-38.6 167.5 0 244.2l90.4-69.9z"/><path fill="#ea4335" d="M272.1 107.7c38.9-.6 76.5 14 105 40.8l78.1-78.1C407.2 24.8 349.8.2 288.8 0 186.8 0 91.8 57.6 45.6 149.5l90.4 70.4c21.5-64.4 81.9-112.2 152.8-112.2z"/></svg>
                <span>Iniciar con Google</span>
            </a>
        </div>
    </form>
</x-guest-layout>
