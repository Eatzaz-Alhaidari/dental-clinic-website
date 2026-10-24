@props([
    'size' => 'md', // sm, md, lg, xl
    'showText' => true,
    'showSubtitle' => true,
    'inverted' => false, // for dark backgrounds
])

@php
    $dimensions = match($size) {
        'sm' => ['box' => 'w-9 h-9', 'img' => 'w-7 h-7', 'title' => 'text-base', 'sub' => 'text-[10px]'],
        'md' => ['box' => 'w-12 h-12', 'img' => 'w-10 h-10', 'title' => 'text-xl sm:text-2xl', 'sub' => 'text-xs'],
        'lg' => ['box' => 'w-16 h-16', 'img' => 'w-14 h-14', 'title' => 'text-2xl sm:text-3xl', 'sub' => 'text-sm'],
        'xl' => ['box' => 'w-24 h-24', 'img' => 'w-20 h-20', 'title' => 'text-3xl sm:text-4xl', 'sub' => 'text-base'],
        default => ['box' => 'w-12 h-12', 'img' => 'w-10 h-10', 'title' => 'text-xl sm:text-2xl', 'sub' => 'text-xs'],
    };

    $titleColor = $inverted ? 'text-white' : 'text-[#3B2A1E]';
    $subtitleColor = $inverted ? 'text-[#F0DDA8]' : 'text-[#D4AF37]';
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-3 group']) }}>
    <!-- Emblem Box with 3D Gold Accent and Dar Al-Uloom Emblem -->
    <div class="{{ $dimensions['box'] }} shrink-0 rounded-2xl bg-gradient-to-tr from-[#3B2A1E] via-[#2A1D15] to-[#1F150F] p-1 flex items-center justify-center shadow-lg border-2 border-[#D4AF37]/60 group-hover:border-[#D4AF37] group-hover:scale-105 transition-all duration-300 relative overflow-hidden">
        <img 
            src="{{ asset('images/logo-emblem-precise.png') }}" 
            alt="{{ __('messages.clinic_name') }}" 
            class="{{ $dimensions['img'] }} object-contain drop-shadow-md rounded-xl"
            loading="eager"
        >
        <!-- Subtle gold reflection highlight -->
        <span class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent pointer-events-none"></span>
    </div>

    @if($showText)
        <div class="leading-tight">
            <span class="{{ $dimensions['title'] }} font-black {{ $titleColor }} tracking-tight block group-hover:text-[#D4AF37] transition-colors font-cairo">
                {{ __('messages.clinic_short_name') }}
            </span>
            @if($showSubtitle)
                <span class="{{ $dimensions['sub'] }} font-bold {{ $subtitleColor }} block tracking-wide">
                    {{ __('messages.clinic_specialty') }}
                </span>
            @endif
        </div>
    @endif
</div>
