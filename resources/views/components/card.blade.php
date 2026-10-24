@props([
    'accent' => 'brown', // 'brown' or 'gold'
    'class' => '',
])

@php
$borderTop = match($accent) {
    'gold' => 'border-t-4 border-t-[#D4AF37]',
    'orange' => 'border-t-4 border-t-[#F39200]',
    default => 'border-t-4 border-t-[#3B2A1E]',
};
@endphp

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl p-6 md:p-8 shadow-[0_4px_20px_-2px_rgba(59,42,30,0.06),0_2px_6px_-1px_rgba(59,42,30,0.04)] border border-amber-100/70 {$borderTop} transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_30px_-4px_rgba(212,175,55,0.18)] {$class}"]) }}>
    {{ $slot }}
</div>
