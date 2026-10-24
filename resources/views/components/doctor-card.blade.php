@props([
    'doctor',
])

@php
$locale = app()->getLocale();
$name = $doctor->getTranslation('name', $locale);
$specialty = $doctor->getTranslation('specialty', $locale);
$bio = $doctor->getTranslation('bio', $locale);
@endphp

<x-card accent="gold" class="flex flex-col justify-between group overflow-hidden">
    <div>
        <div class="relative mb-5 -mx-6 -mt-6 md:-mx-8 md:-mt-8 h-48 bg-gradient-to-br from-[#3B2A1E] to-[#261A13] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            @if($doctor->photo && file_exists(public_path('storage/' . $doctor->photo)))
                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-[#D4AF37] to-[#F0DDA8] flex items-center justify-center text-[#3B2A1E] shadow-xl border-4 border-white/20 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
            @endif

            <div class="absolute bottom-3 end-3 flex gap-1">
                @foreach($doctor->branches as $branch)
                    <span class="bg-[#3B2A1E]/80 backdrop-blur-md text-[#F0DDA8] border border-amber-200/30 text-xs px-2.5 py-1 rounded-full font-semibold">
                        {{ $branch->getTranslation('name', $locale) }}
                    </span>
                @endforeach
            </div>
        </div>

        <h3 class="text-xl font-extrabold text-[#3B2A1E] mb-1 group-hover:text-[#D4AF37] transition-colors">
            <a href="{{ route('doctors.show', $doctor) }}">
                {{ $name }}
            </a>
        </h3>

        <p class="text-xs font-bold text-[#D4AF37] mb-3">
            {{ $specialty }}
        </p>

        <p class="text-stone-600 text-sm leading-relaxed mb-4 line-clamp-2">
            {{ $bio }}
        </p>

        @if($doctor->services->isNotEmpty())
            <div class="mb-4 flex flex-wrap gap-1.5">
                @foreach($doctor->services->take(2) as $service)
                    <span class="text-[11px] font-medium bg-amber-50 text-[#3B2A1E] border border-amber-200/60 px-2 py-0.5 rounded-md">
                        {{ $service->getTranslation('name', $locale) }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="pt-4 border-t border-amber-100 flex items-center justify-between mt-auto">
        <a href="{{ route('doctors.show', $doctor) }}" class="text-xs font-bold text-[#3B2A1E] hover:text-[#D4AF37] inline-flex items-center gap-1 transition-colors">
            <span>{{ $locale === 'en' ? 'View Profile' : 'الملف الطبي' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 rtl:rotate-180">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>

        <x-button variant="brown" :href="route('booking.index')" class="!px-3 !py-1.5 !text-xs">
            {{ $locale === 'en' ? 'Book' : 'احجز موعداً' }}
        </x-button>
    </div>
</x-card>
