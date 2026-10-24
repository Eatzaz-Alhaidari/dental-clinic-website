@props([
    'services',
])

@php
$locale = app()->getLocale();

$iconSvgs = [
    'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />',
    'face-smile' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />',
    'shield-check' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />',
    'heart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />',
    'bolt' => '<path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />',
    'check-badge' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />',
];
@endphp

<div class="bg-gradient-to-r from-[#3B2A1E] via-[#2F2117] to-[#3B2A1E] text-white py-3 border-y border-[#D4AF37]/30 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 overflow-x-auto no-scrollbar py-1">
            <span class="text-xs font-bold text-[#D4AF37] whitespace-nowrap shrink-0 flex items-center gap-1.5 border-e border-[#D4AF37]/30 pe-4">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                {{ $locale === 'en' ? 'Specialties:' : 'التخصصات:' }}
            </span>

            <div class="flex items-center gap-6 lg:gap-8 shrink-0">
                @foreach($services as $service)
                    @php
                        $iconSvg = $iconSvgs[$service->icon] ?? $iconSvgs['sparkles'];
                        $title = $service->getTranslation('name', $locale);
                    @endphp
                    <a href="{{ route('services.show', $service) }}" class="group flex items-center gap-2 text-xs font-semibold text-stone-200 hover:text-[#D4AF37] transition-colors whitespace-nowrap">
                        <span class="w-7 h-7 rounded-lg bg-white/10 group-hover:bg-[#D4AF37] group-hover:text-[#3B2A1E] flex items-center justify-center p-1.5 transition-all text-[#F0DDA8]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                                {!! $iconSvg !!}
                            </svg>
                        </span>
                        <span>{{ $title }}</span>
                    </a>
                @endforeach
            </div>

            <a href="{{ route('services.index') }}" class="text-xs text-[#F0DDA8] hover:text-white font-bold whitespace-nowrap underline shrink-0 border-s border-[#D4AF37]/30 ps-4">
                {{ $locale === 'en' ? 'View all services' : 'عرض الكل' }}
            </a>
        </div>
    </div>
</div>
