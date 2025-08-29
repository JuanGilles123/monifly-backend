<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name','MoniFly') }} – Acceso</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .fade-in{opacity:0;transform:translateY(10px);animation:fade .6s ease forwards}
        @keyframes fade{to{opacity:1;transform:none}}
    </style>
</head>
<body class="min-h-screen bg-neutral-950 text-neutral-100 flex flex-col items-center justify-center px-4 py-10 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 via-neutral-900 to-neutral-950"></div>
    <div class="absolute inset-0 pointer-events-none" style="background-image:radial-gradient(circle at 50% 40%,rgba(255,255,255,0.08),transparent 55%),linear-gradient(#ffffff08 1px,transparent 1px),linear-gradient(90deg,#ffffff08 1px,transparent 1px);background-size:100% 100%,48px 48px,48px 48px;mask:linear-gradient(to bottom,rgba(0,0,0,.85),transparent 90%)"></div>
    <div class="relative z-10 w-full max-w-md fade-in">
        <div class="flex justify-center mb-8 select-none">
            <a href="/" class="text-3xl font-semibold tracking-tight">
                <span class="text-emerald-400">{{ config('app.name','MoniFly') }}</span>
            </a>
        </div>
        <div class="bg-neutral-900/70 backdrop-blur rounded-2xl border border-neutral-800 p-8 shadow-xl shadow-black/40">
            {{ $slot }}
            @if (Route::has('google.redirect'))
            <div class="mt-8">
                <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 px-5 py-3 rounded-full bg-white text-neutral-900 font-medium hover:bg-neutral-200 transition">
                    <svg width="18" height="18" viewBox="0 0 533.5 544.3"><path fill="#4285f4" d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h146.9c-6.2 33.8-25.6 63.6-54.4 82.7v68h87.7c51.3-47.2 81.2-116.7 81.2-200.2z"/><path fill="#34a853" d="M272.1 544.3c73.5 0 135.3-24.3 180.4-65.7l-87.7-68c-24.4 16.6-55.8 26-92.6 26-71 0-131.2-47.9-152.8-112.2H28.9v70.4c46.2 91.9 141.2 149.5 243.2 149.5z"/><path fill="#fbbc04" d="M119.3 324.4c-10.2-30.3-10.2-63.6 0-93.9V160.1H28.9c-38.6 76.7-38.6 167.5 0 244.2l90.4-69.9z"/><path fill="#ea4335" d="M272.1 107.7c38.9-.6 76.5 14 105 40.8l78.1-78.1C407.2 24.8 349.8.2 288.8 0 186.8 0 91.8 57.6 45.6 149.5l90.4 70.4c21.5-64.4 81.9-112.2 152.8-112.2z"/></svg>
                    <span>Continuar con Google</span>
                </a>
            </div>
            @endif
        </div>
        <p class="mt-6 text-center text-xs text-neutral-500">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>
</html>
