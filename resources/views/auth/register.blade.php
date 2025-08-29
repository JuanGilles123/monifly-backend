<x-guest-layout>
    <!-- Google OAuth Button -->
    <div class="mb-6">
        <a href="{{ route('google.redirect') }}" 
           class="w-full inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            {{ __('Sign up with Google') }}
        </a>
    </div>

    <!-- Divider -->
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">{{ __('Or sign up with email') }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">{{ __('Select your country') }}</option>
                <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>🇺🇸 United States</option>
                <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>🇨🇦 Canada</option>
                <option value="MX" {{ old('country') == 'MX' ? 'selected' : '' }}>🇲🇽 México</option>
                <option value="CO" {{ old('country') == 'CO' ? 'selected' : '' }}>🇨🇴 Colombia</option>
                <option value="AR" {{ old('country') == 'AR' ? 'selected' : '' }}>🇦🇷 Argentina</option>
                <option value="BR" {{ old('country') == 'BR' ? 'selected' : '' }}>🇧🇷 Brasil</option>
                <option value="CL" {{ old('country') == 'CL' ? 'selected' : '' }}>🇨🇱 Chile</option>
                <option value="PE" {{ old('country') == 'PE' ? 'selected' : '' }}>🇵🇪 Perú</option>
                <option value="EC" {{ old('country') == 'EC' ? 'selected' : '' }}>🇪🇨 Ecuador</option>
                <option value="ES" {{ old('country') == 'ES' ? 'selected' : '' }}>🇪🇸 España</option>
                <option value="GB" {{ old('country') == 'GB' ? 'selected' : '' }}>🇬🇧 United Kingdom</option>
                <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>🇫🇷 France</option>
                <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>🇩🇪 Germany</option>
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Currency -->
        <div class="mt-4">
            <x-input-label for="currency" :value="__('Preferred Currency')" />
            <select id="currency" name="currency" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">{{ __('Select currency') }}</option>
                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>💵 USD - US Dollar</option>
                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>💶 EUR - Euro</option>
                <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>🍁 CAD - Canadian Dollar</option>
                <option value="MXN" {{ old('currency') == 'MXN' ? 'selected' : '' }}>🇲🇽 MXN - Mexican Peso</option>
                <option value="COP" {{ old('currency') == 'COP' ? 'selected' : '' }}>🇨🇴 COP - Colombian Peso</option>
                <option value="ARS" {{ old('currency') == 'ARS' ? 'selected' : '' }}>🇦🇷 ARS - Argentine Peso</option>
                <option value="BRL" {{ old('currency') == 'BRL' ? 'selected' : '' }}>🇧🇷 BRL - Brazilian Real</option>
                <option value="CLP" {{ old('currency') == 'CLP' ? 'selected' : '' }}>🇨🇱 CLP - Chilean Peso</option>
                <option value="PEN" {{ old('currency') == 'PEN' ? 'selected' : '' }}>🇵🇪 PEN - Peruvian Sol</option>
                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>💷 GBP - British Pound</option>
            </select>
            <x-input-error :messages="$errors->get('currency')" class="mt-2" />
        </div>

        <!-- Optional First Goal -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-sm font-medium text-gray-700 mb-3">{{ __('🎯 Set your first financial goal (optional)') }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="goal_name" :value="__('Goal Name')" />
                    <x-text-input id="goal_name" class="block mt-1 w-full" type="text" name="goal_name" 
                                  :value="old('goal_name')" placeholder="e.g., Emergency Fund" />
                    <x-input-error :messages="$errors->get('goal_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="goal_target" :value="__('Target Amount')" />
                    <x-text-input id="goal_target" class="block mt-1 w-full" type="number" name="goal_target" 
                                  :value="old('goal_target')" step="0.01" min="0" placeholder="1000.00" />
                    <x-input-error :messages="$errors->get('goal_target')" class="mt-2" />
                </div>
            </div>

            <p class="text-xs text-gray-500 mt-2">
                {{ __('Setting a goal helps you track your financial progress from day one!') }}
            </p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
