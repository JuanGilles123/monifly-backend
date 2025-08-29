@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md bg-white/5 border border-white/20 text-white placeholder-white/40 focus:border-emerald-400 focus:ring-emerald-400 focus:ring-2 transition']) }}>
