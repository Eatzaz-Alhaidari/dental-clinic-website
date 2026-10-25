@extends('layouts.app')

@php
$locale = app()->getLocale();
$name = $service->getTranslation('name', $locale);
$desc = $service->getTranslation('description', $locale);
@endphp

@section('title', $name)

@section('content')
    <!-- Service Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs text-[#F0DDA8] font-bold mb-4">
                <a href="{{ route('home') }}" class="hover:underline">{{ __('messages.nav.home') }}</a>
                <span>&rsaquo;</span>
                <a href="{{ route('services.index') }}" class="hover:underline">{{ __('messages.nav.services') }}</a>
                <span>&rsaquo;</span>
                <span class="text-white">{{ $name }}</span>
            </div>

            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                    {{ $name }}
                </h1>
                <p class="text-stone-300 text-base leading-relaxed">
                    {{ $desc }}
                </p>
            </div>
        </div>
    </section>

    <!-- Details Content & Doctors Section -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Main Service Description & Features -->
                <div class="lg:col-span-8 space-y-8">
                    <x-card accent="brown">
                        <h2 class="text-2xl font-black text-[#3B2A1E] mb-4">
                            {{ app()->getLocale() === 'en' ? 'About This Treatment' : 'عن هذا الإجراء العلاجي والتقنيات المستخدمة' }}
                        </h2>
                        <p class="text-stone-700 leading-relaxed text-base mb-6">
                            {{ $desc }}
                        </p>

                        <div class="p-6 rounded-2xl bg-amber-50/70 border border-amber-200/80 mb-6">
                            <h3 class="font-bold text-[#3B2A1E] text-base mb-3 flex items-center gap-2">
                                <span class="text-[#D4AF37] font-black text-xl">✦</span>
                                <span>{{ app()->getLocale() === 'en' ? 'Why get this treatment at Dar Al Uloom Clinic?' : 'مميزات تلقي هذا العلاج في عيادة دار العلوم:' }}</span>
                            </h3>
                            <ul class="space-y-2 text-sm text-stone-700">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <span>{{ app()->getLocale() === 'en' ? 'Supervised by board-certified specialists.' : 'إشراف مباشر من أطباء استشاريين معتمدين متخصصين في هذا المجال.' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <span>{{ app()->getLocale() === 'en' ? 'Fully available across all Riyadh, Jeddah, and Taif branches.' : 'متوفر بجميع فروعنا في الرياض، جدة، والطائف بأحدث المعدات والأجهزة الرقمية.' }}</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <span>{{ app()->getLocale() === 'en' ? 'Transparent consultation and gentle pain-free sessions.' : 'خطة علاجية مسبقة وواضحة، مع التركيز على راحة المريض التامة وبدون ألم.' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-wrap gap-4 pt-4 border-t border-amber-100">
                            <x-button variant="gold" :href="route('booking.index')">
                                {{ __('messages.nav.book_appointment') }}
                            </x-button>
                            <x-button variant="whatsapp" href="https://wa.me/967771234567?text={{ rawurlencode('مرحباً، أود حجز موعد لخدمة: ' . $name) }}" target="_blank">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                                </svg>
                                <span>{{ app()->getLocale() === 'en' ? 'Inquire on WhatsApp' : 'استفسر عبر الواتساب' }}</span>
                            </x-button>
                        </div>
                    </x-card>

                    <!-- Doctors offering this service -->
                    @if($service->doctors->isNotEmpty())
                        <div>
                            <div class="mb-6">
                                <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">
                                    {{ app()->getLocale() === 'en' ? 'Specialist Doctors' : 'الأطباء الممارسون' }}
                                </span>
                                <h3 class="text-2xl font-black text-[#3B2A1E]">
                                    {{ app()->getLocale() === 'en' ? 'Doctors Providing This Service' : 'أطباء يقدمون هذه الخدمة في فروعنا' }}
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                @foreach($service->doctors as $doctor)
                                    <x-doctor-card :doctor="$doctor" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar (Related Services & Branch Info) -->
                <div class="lg:col-span-4 space-y-8">
                    <!-- Quick Booking Card -->
                    <x-card accent="gold" class="bg-gradient-to-br from-white to-amber-50/50">
                        <h4 class="text-xl font-black text-[#3B2A1E] mb-3">
                            {{ __('messages.booking.title') }}
                        </h4>
                        <p class="text-stone-600 text-xs mb-6 leading-relaxed">
                            {{ app()->getLocale() === 'en' ? 'Appointments are confirmed promptly by our receptionist via WhatsApp.' : 'اختر الفرع الأنسب لك وسيتم تأكيد موعدك مباشرة عبر واتساب الفرع.' }}
                        </p>
                        <x-button variant="gold" :href="route('booking.index')" class="w-full text-center">
                            {{ __('messages.nav.book_appointment') }}
                        </x-button>
                    </x-card>

                    <!-- Related Services List -->
                    @if(isset($relatedServices) && $relatedServices->isNotEmpty())
                        <x-card accent="brown">
                            <h4 class="text-lg font-bold text-[#3B2A1E] mb-4 pb-2 border-b border-amber-100">
                                {{ app()->getLocale() === 'en' ? 'Other Dental Services' : 'خدمات سنية أخرى' }}
                            </h4>
                            <div class="space-y-3">
                                @foreach($relatedServices as $related)
                                    <a href="{{ route('services.show', $related) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-amber-50 transition-colors group">
                                        <span class="text-sm font-bold text-[#3B2A1E] group-hover:text-[#D4AF37] transition-colors">
                                            {{ $related->getTranslation('name', $locale) }}
                                        </span>
                                        <svg class="w-4 h-4 text-stone-400 group-hover:text-[#D4AF37] rtl:rotate-180 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
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
