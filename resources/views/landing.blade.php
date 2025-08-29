<x-guest-layout>
  <div class="min-h-screen grid place-items-center bg-[url('/images/bg.jpg')] bg-cover">
    <div class="backdrop-blur-md bg-white/10 border border-white/20 rounded-2xl p-8 w-full max-w-md">
      <h1 class="text-3xl font-bold text-center mb-2">MoniFly</h1>
      <p class="text-center text-white/70 mb-6">Organiza tus finanzas y vuela ligero.</p>
      <div class="flex gap-3">
        <a href="{{ route('login') }}" class="flex-1 text-center rounded-lg bg-white/10 hover:bg-white/20 py-2">Ingresar</a>
        <a href="{{ route('register') }}" class="flex-1 text-center rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white py-2">Crear cuenta</a>
      </div>
    </div>
  </div>
</x-guest-layout>