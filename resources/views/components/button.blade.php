@props([
    'variant' => 'gold', // 'gold', 'brown', 'whatsapp', 'outline'
    'href' => null,
    'type' => 'button',
    'class' => '',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-bold px-6 py-3 rounded-full transition-all duration-300 gap-2 cursor-pointer text-sm md:text-base';

$variants = [
    'gold' => 'bg-gradient-to-r from-[#D4AF37] to-[#B89326] hover:from-[#E2BC44] hover:to-[#C8A232] text-white shadow-[0_4px_15px_rgba(212,175,55,0.35)] hover:shadow-[0_8px_25px_rgba(212,175,55,0.45)] hover:-translate-y-0.5 active:translate-y-0',
    'brown' => 'bg-[#3B2A1E] hover:bg-[#261A13] text-white shadow-[0_4px_14px_rgba(59,42,30,0.25)] hover:shadow-[0_8px_22px_rgba(59,42,30,0.35)] hover:-translate-y-0.5 active:translate-y-0',
    'whatsapp' => 'bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-[0_4px_14px_rgba(37,211,102,0.3)] hover:shadow-[0_8px_20px_rgba(37,211,102,0.4)] hover:-translate-y-0.5 active:translate-y-0',
    'outline' => 'bg-transparent border-2 border-[#3B2A1E] text-[#3B2A1E] hover:bg-[#3B2A1E] hover:text-white',
    'outline-gold' => 'bg-transparent border-2 border-[#D4AF37] text-[#8E7019] hover:bg-[#D4AF37] hover:text-white',
];

$classes = "{$baseClasses} " . ($variants[$variant] ?? $variants['gold']) . " {$class}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
