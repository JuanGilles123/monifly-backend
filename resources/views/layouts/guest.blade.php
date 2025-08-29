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
        </div>
        <p class="mt-6 text-center text-xs text-neutral-500">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>
</html>
