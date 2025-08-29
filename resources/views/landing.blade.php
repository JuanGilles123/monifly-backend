<x-guest-layout>
<div class="min-h-[100dvh] overflow-y-auto bg-cover bg-center"
style="background-image:url('/images/bg.jpg');"
>
<div class="min-h-[100dvh] md:min-h-screen grid place-items-center p-4 pb-[env(safe-area-inset-bottom)]">
<div class="w-full max-w-md backdrop-blur-xl bg-white/10 border border-white/15 shadow-2xl rounded-2xl p-6">
<h1 class="text-3xl font-bold text-center">MoniFly</h1>
<p class="text-center text-white/70">Organiza tus finanzas y vuela ligero.</p>
<div class="mt-6 flex gap-3">
<a class="flex-1 text-center rounded-lg bg-white/10 hover:bg-white/20 py-2" href="{{ route('login') }}">Ingresar</a>
<a class="flex-1 text-center rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white py-2" href="{{ route('register') }}">Crear cuenta</a>
</div>
</div>
</div>
</div>
</x-guest-layout>