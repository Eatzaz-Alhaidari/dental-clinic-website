@props([
    'service',
])

@php
$locale = app()->getLocale();
$name = $service->getTranslation('name', $locale);
$desc = $service->getTranslation('description', $locale);

// Map icons to SVG or stylish visual icons
$iconSvgs = [
    'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />',
    'face-smile' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />',
    'shield-check' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />',
    'heart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />',
    'bolt' => '<path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />',
    'check-badge' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />',
];

$iconSvg = $iconSvgs[$service->icon] ?? $iconSvgs['sparkles'];
@endphp

<x-card accent="brown" class="flex flex-col justify-between group">
    <div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#FFF9EC] to-[#F0DDA8] text-[#3B2A1E] flex items-center justify-center p-3 shadow-inner group-hover:scale-110 group-hover:bg-[#3B2A1E] group-hover:text-[#D4AF37] transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                    {!! $iconSvg !!}
                </svg>
            </div>
            <span class="text-xs font-bold text-[#D4AF37] bg-[#FFF9EC] border border-amber-200/80 px-3 py-1 rounded-full">
                {{ $locale === 'en' ? 'Specialized Care' : 'رعاية متخصصة' }}
            </span>
        </div>

        <h3 class="text-xl font-bold text-[#3B2A1E] mb-2 group-hover:text-[#D4AF37] transition-colors">
            <a href="{{ route('services.show', $service) }}">
                {{ $name }}
            </a>
        </h3>

        <p class="text-stone-600 text-sm leading-relaxed mb-6 line-clamp-3">
            {{ $desc }}
        </p>
    </div>

    <div class="pt-4 border-t border-amber-100 flex items-center justify-between mt-auto">
        <a href="{{ route('services.show', $service) }}" class="text-sm font-bold text-[#3B2A1E] hover:text-[#D4AF37] inline-flex items-center gap-1 group-hover:gap-2 transition-all">
            <span>{{ $locale === 'en' ? 'Learn more' : 'تفاصيل الخدمة' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 rtl:rotate-180">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>

        <a href="{{ route('booking.index') }}" class="text-xs font-bold text-[#D4AF37] hover:underline">
            {{ $locale === 'en' ? 'Book Now' : 'احجز الآن' }}
        </a>
    </div>
</x-card>
