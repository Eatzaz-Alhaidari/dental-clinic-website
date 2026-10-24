@extends('layouts.app')

@php
$locale = app()->getLocale();
$name = $doctor->getTranslation('name', $locale);
$specialty = $doctor->getTranslation('specialty', $locale);
$bio = $doctor->getTranslation('bio', $locale);
@endphp

@section('title', $name . ' - ' . $specialty)

@section('content')
    <!-- Doctor Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs text-[#F0DDA8] font-bold mb-4">
                <a href="{{ route('home') }}" class="hover:underline">{{ __('messages.nav.home') }}</a>
                <span>&rsaquo;</span>
                <a href="{{ route('doctors.index') }}" class="hover:underline">{{ __('messages.nav.doctors') }}</a>
                <span>&rsaquo;</span>
                <span class="text-white">{{ $name }}</span>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                <!-- Doctor Avatar Photo -->
                <div class="w-32 h-32 md:w-40 md:md-40 rounded-3xl bg-gradient-to-tr from-[#D4AF37] to-[#F0DDA8] flex items-center justify-center text-[#3B2A1E] shadow-2xl border-4 border-white/20 shrink-0 overflow-hidden">
                    @if($doctor->photo && file_exists(public_path('storage/' . $doctor->photo)))
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $name }}" class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-20 h-20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    @endif
                </div>

                <!-- Info -->
                <div class="text-center md:text-start">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 mb-2">
                        @foreach($doctor->branches as $branch)
                            <span class="bg-[#D4AF37] text-[#3B2A1E] font-extrabold text-xs px-3 py-1 rounded-full">
                                {{ $branch->getTranslation('name', $locale) }}
                            </span>
                        @endforeach
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black mb-2">{{ $name }}</h1>
                    <p class="text-base text-[#F0DDA8] font-bold mb-4">{{ $specialty }}</p>

                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        <x-button variant="gold" :href="route('booking.index')">
                            {{ __('messages.nav.book_appointment') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Details & Schedule -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Main Bio & Practice -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Bio Card -->
                    <x-card accent="brown">
                        <h2 class="text-2xl font-black text-[#3B2A1E] mb-4 pb-2 border-b border-amber-100">
                            {{ app()->getLocale() === 'en' ? 'About the Doctor & Qualifications' : 'النبذة المهنية والمؤهلات الأكاديمية' }}
                        </h2>
                        <p class="text-stone-700 leading-relaxed text-base mb-6">
                            {{ $bio }}
                        </p>

                        <!-- Specialties Offered by Doctor -->
                        <h3 class="font-bold text-[#3B2A1E] text-base mb-3">
                            {{ app()->getLocale() === 'en' ? 'Clinical Services Provided:' : 'الخدمات العلاجية التي يقدمها الطبيب:' }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($doctor->services as $service)
                                <a href="{{ route('services.show', $service) }}" class="p-3.5 rounded-xl bg-amber-50/70 border border-amber-200/70 hover:bg-amber-100/60 transition-colors flex items-center justify-between group">
                                    <span class="text-sm font-bold text-[#3B2A1E] group-hover:text-[#D4AF37]">
                                        {{ $service->getTranslation('name', $locale) }}
                                    </span>
                                    <svg class="w-4 h-4 text-stone-400 group-hover:text-[#D4AF37] rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </x-card>

                    <!-- Branches Availability -->
                    <div>
                        <h3 class="text-2xl font-black text-[#3B2A1E] mb-6">
                            {{ app()->getLocale() === 'en' ? 'Available at Branches:' : 'الفروع المتاح بها الطبيب لخدمتكم:' }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($doctor->branches as $branch)
                                <x-branch-card :branch="$branch" />
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Booking Callout & Other Doctors) -->
                <div class="lg:col-span-4 space-y-8">
                    <x-card accent="gold" class="bg-gradient-to-br from-white to-amber-50/50">
                        <h4 class="text-xl font-black text-[#3B2A1E] mb-2">
                            {{ app()->getLocale() === 'en' ? 'Book with ' . $name : 'حجز موعد مع ' . $name }}
                        </h4>
                        <p class="text-xs text-stone-600 mb-6 leading-relaxed">
                            {{ app()->getLocale() === 'en' ? 'Select your branch and preferred time, and our clinic staff will confirm immediately.' : 'حدد الفرع والوقت المناسب وسيتم تأكيد جلستك الطبية والتنسيق معك مباشرة.' }}
                        </p>
                        <x-button variant="gold" :href="route('booking.index')" class="w-full text-center">
                            {{ __('messages.nav.book_appointment') }}
                        </x-button>
                    </x-card>

                    @if(isset($relatedDoctors) && $relatedDoctors->isNotEmpty())
                        <x-card accent="brown">
                            <h4 class="text-lg font-bold text-[#3B2A1E] mb-4 pb-2 border-b border-amber-100">
                                {{ app()->getLocale() === 'en' ? 'Other Doctors' : 'أطباء واستشاريون آخرون' }}
                            </h4>
                            <div class="space-y-4">
                                @foreach($relatedDoctors as $related)
                                    <a href="{{ route('doctors.show', $related) }}" class="flex items-center gap-3 p-2 rounded-xl hover:bg-amber-50 transition-colors group">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#D4AF37] to-[#F0DDA8] flex items-center justify-center text-[#3B2A1E] font-bold text-xs shrink-0">
                                            Dr
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="text-sm font-bold text-[#3B2A1E] truncate group-hover:text-[#D4AF37]">
                                                {{ $related->getTranslation('name', $locale) }}
                                            </h5>
                                            <span class="text-xs text-stone-500 truncate block">
                                                {{ $related->getTranslation('specialty', $locale) }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </x-card>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection
