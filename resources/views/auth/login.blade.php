<x-guest-layout>
<div class="min-h-[100dvh] overflow-y-auto bg-cover bg-center" style="background-image:url('/images/bg.jpg'),linear-gradient(135deg,#0f172a,#0d2622);">
<div class="min-h-[100dvh] grid place-items-center p-4 pb-[env(safe-area-inset-bottom)]">
<div class="w-full max-w-md backdrop-blur-xl bg-white/10 border border-white/15 rounded-2xl p-6">
<h1 class="text-2xl font-bold text-center mb-1">MoniFly</h1>
<p class="text-center text-white/60 mb-6">Inicia sesión</p>


<div class="mb-4">
    <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 rounded-lg bg-white text-gray-900 hover:bg-gray-100 py-2.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.6 20.5H42v-.1H24v7.2h11.3C33.7 31 29.4 34 24 34c-7 0-12.8-5.8-12.8-12.8S17 8.4 24 8.4c3.3 0 6.2 1.2 8.5 3.3l5-5C34.3 3.6 29.4 1.6 24 1.6 11.9 1.6 2 11.5 2 23.6S11.9 45.6 24 45.6 46 35.7 46 23.6c0-1-.1-2-.4-3.1z"/><path fill="#FF3D00" d="M6.3 14.7l5.9 4.3C13.4 15 18.3 12 24 12c3.3 0 6.2 1.2 8.5 3.3l5-5C34.3 3.6 29.4 1.6 24 1.6 15 1.6 7.7 6.6 4.3 14.7z"/><path fill="#4CAF50" d="M24 45.6c5.3 0 10.2-1.8 14-4.8l-6.5-5.3C29.4 37 26.8 38 24 38c-5.3 0-9.8-3.6-11.5-8.5l-6.3 4.9C9.8 41.6 16.3 45.6 24 45.6z"/><path fill="#1976D2" d="M43.6 20.5H42v-.1H24v7.2h11.3C33.7 31 29.4 34 24 34c-7 0-12.8-5.8-12.8-12.8S17 8.4 24 8.4c-9.5 0-18 7.7-21.4 18.4l6.3 4.9C9.8 41.6 16.3 45.6 24 45.6z"/></svg>
        <span>Continuar con Google</span>
    </a>
</div>


<div class="my-4 flex items-center gap-2 text-white/40">
<div class="h-px flex-1 bg-white/15"></div>
<span>o con correo</span>
<div class="h-px flex-1 bg-white/15"></div>
</div>


<form method="POST" action="{{ route('login') }}" x-data="{busy:false}" @submit="busy=true">
@csrf
<div class="space-y-3">
<div>
<x-input-label for="email" value="Correo" />
<x-text-input id="email" name="email" type="email" class="mt-1" :value="old('email')" required autofocus autocomplete="username" placeholder="tu@correo.com" />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>
<div>
<x-input-label for="password" value="Contraseña" />
<x-text-input id="password" name="password" type="password" class="mt-1" required autocomplete="current-password" placeholder="••••••••" />
</div>
</div>
<div class="mt-4 flex items-center justify-between text-sm">
<label class="inline-flex items-center gap-2"><input type="checkbox" name="remember" class="rounded bg-white/10 border-white/20"> Recordarme</label>
<a href="{{ route('password.request') }}" class="text-indigo-300 hover:text-indigo-200">¿Olvidaste tu contraseña?</a>
</div>
<button :disabled="busy" class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 text-white py-2.5 disabled:opacity-50">
<svg x-show="busy" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg>
<span x-text="busy ? 'Ingresando…' : 'Ingresar'"></span>
</button>
</form>


<p class="mt-4 text-center text-sm">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-indigo-300 hover:text-indigo-200">Crea una</a></p>
</div>
</div>
</div>
</x-guest-layout>
