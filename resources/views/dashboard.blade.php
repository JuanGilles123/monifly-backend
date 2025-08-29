<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - MoniFly
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold">¡Bienvenido, {{ $user->name }}!</h3>
                            <p class="text-gray-600 mt-1">
                                @if($user->email_verified_at)
                                    ✅ Email verificado
                                @else
                                    ⚠️ <a href="{{ route('verification.notice') }}" class="text-blue-600 hover:underline">Verifica tu email</a>
                                @endif
                                @if($user->provider === 'google')
                                    | 🔗 Conectado con Google
                                @endif
                            </p>
                        </div>
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $totalGoals }}</div>
                        <div class="text-sm text-gray-600">Metas Totales</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $completedGoals }}</div>
                        <div class="text-sm text-gray-600">Metas Completadas</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-purple-600">${{ number_format($totalTargetAmount, 2) }}</div>
                        <div class="text-sm text-gray-600">Objetivo Total</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-indigo-600">${{ number_format($totalProgressAmount, 2) }}</div>
                        <div class="text-sm text-gray-600">Progreso Total</div>
                    </div>
                </div>
            </div>

            <!-- Goals Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Tus Metas Financieras</h3>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Nueva Meta
                        </button>
                    </div>

                    @if($goals->count() > 0)
                        <div class="space-y-4">
                            @foreach($goals as $goal)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold">{{ $goal->name }}</h4>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-600">{{ $goal->currency }}</span>
                                            @if($goal->is_completed)
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Completada</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>${{ number_format($goal->progress_amount, 2) }} de ${{ number_format($goal->target_amount, 2) }}</span>
                                            <span>{{ number_format($goal->progress_percentage, 1) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($goal->progress_percentage, 100) }}%"></div>
                                        </div>
                                    </div>
                                    @if($goal->target_date)
                                        <p class="text-xs text-gray-500">Meta para: {{ $goal->target_date->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <p>No tienes metas financieras aún.</p>
                            <p class="text-sm">¡Crea tu primera meta para empezar tu camino hacia la libertad financiera!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
