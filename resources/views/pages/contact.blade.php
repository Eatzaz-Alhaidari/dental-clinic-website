@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Contact Us - Dar Al Uloom Clinic' : 'تواصل معنا - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Get In Touch' : 'قنوات الاتصال المباشرة' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                {{ __('messages.nav.contact') }}
            </h1>
            <p class="text-stone-300 max-w-2xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'We are here to answer your inquiries and assist you with appointments across our Riyadh, Jeddah, and Taif branches.' : 'فريق الاستقبال في فروعنا بالرياض، جدة، والطائف متاح للإجابة على جميع استفساراتكم وحجز مواعيدكم بسهولة عبر الهاتف الموحد أو الواتساب.' }}
            </p>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                
                @foreach($branches as $branch)
                    @php
                        $locale = app()->getLocale();
                        $name = $branch->getTranslation('name', $locale);
                        $address = $branch->getTranslation('address', $locale);
                        $hours = $branch->getTranslation('working_hours', $locale);
                        $cleanWa = $branch->clean_whatsapp_number;
                    @endphp
                    <x-card accent="brown">
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-amber-100">
                            <div>
                                <span class="text-xs font-bold text-[#D4AF37] uppercase block mb-0.5">{{ $locale === 'en' ? 'Direct Branch Line' : 'قناة التواصل الرسمية' }}</span>
                                <h3 class="text-2xl font-black text-[#3B2A1E]">{{ $name }}</h3>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm animate-pulse"></span>
                        </div>

                        <div class="space-y-4 mb-8 text-sm text-stone-700">
                            <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/60 flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#3B2A1E] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ __('messages.address') }}</span>
                                    <span>{{ $address }}</span>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/60 flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#3B2A1E] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ __('messages.working_hours') }}</span>
                                    <span>{{ $hours }}</span>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/60 flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#3B2A1E] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ __('messages.phone') }}</span>
                                    <a href="tel:{{ $branch->phone }}" class="text-[#3B2A1E] hover:text-[#D4AF37] font-bold text-base" dir="ltr">{{ $branch->phone }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('مرحباً بك في ' . $name . '، أود الاستفسار عن المواعيد.') }}" target="_blank" class="btn-whatsapp flex-1 text-center text-xs">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                                </svg>
                                <span>{{ $locale === 'en' ? 'WhatsApp ' . $name : 'محادثة واتساب ' . $name }}</span>
                            </a>

                            <x-button variant="gold" :href="route('booking.index')" class="flex-1 text-center text-xs">
                                {{ __('messages.nav.book_appointment') }}
                            </x-button>
                        </div>
                    </x-card>
                @endforeach

            </div>
        </div>
    </section>
@endsection
