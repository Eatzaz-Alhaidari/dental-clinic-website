@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Book an Appointment - Dar Al Uloom Clinic' : 'طلب حجز موعد - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-14 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Online Appointment Request' : 'حجز موعد إلكتروني وتأكيد فوري' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-3 font-cairo">
                {{ __('messages.booking.title') }}
            </h1>
            <p class="text-stone-300 max-w-xl mx-auto text-sm sm:text-base">
                {{ __('messages.booking.subtitle') }}
            </p>
        </div>
    </section>

    <!-- Main Booking Form Section -->
    <section class="py-12 md:py-20 bg-[#FFF9EC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Trust Notice Banner -->
            <div class="bg-white/80 backdrop-blur-xs rounded-2xl p-4 sm:p-5 border border-amber-200/80 shadow-xs mb-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-center sm:text-start">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-[#D4AF37] flex items-center justify-center shrink-0 font-bold text-xl">
                        ✦
                    </div>
                    <div>
                        <span class="text-xs font-bold text-[#3B2A1E] block">
                            {{ app()->getLocale() === 'en' ? 'Direct Reception Confirmation in Sana\'a & Ibb' : 'تأكيد مباشر من موظف استقبال فرعك المفضل' }}
                        </span>
                        <span class="text-[11px] text-stone-500 font-medium">
                            {{ app()->getLocale() === 'en' ? 'Your booking will be routed directly to the selected branch team.' : 'سيصل طلبك فوراً إلى مكتب الاستقبال في الفرع المختار ويتم تجهيز العيادة لك.' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-200 shrink-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>{{ app()->getLocale() === 'en' ? 'Instant WhatsApp Dispatch' : 'تحويل تلقائي للواتساب' }}</span>
                </div>
            </div>

            <!-- Livewire Interactive Booking Form Component -->
            <livewire:appointment-booking-form 
                :branch="request()->has('branch') ? (int) request('branch') : null"
                :service="request()->has('service') ? (int) request('service') : null"
                :doctor="request()->has('doctor') ? (int) request('doctor') : null"
            />

            <!-- Clinic Guarantees Footer Strip -->
            <div class="mt-12 pt-8 border-t border-amber-200/60 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                <div class="space-y-1">
                    <span class="text-lg">🛡️</span>
                    <h5 class="text-xs font-bold text-[#3B2A1E]">{{ app()->getLocale() === 'en' ? 'Strict Sterilization' : 'تعقيم أوتوكلاف طبي معتمد' }}</h5>
                    <p class="text-[11px] text-stone-500">{{ app()->getLocale() === 'en' ? 'Hospital-grade hygiene standards' : 'أعلى معايير مكافحة العدوى والوقاية' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-lg">✨</span>
                    <h5 class="text-xs font-bold text-[#3B2A1E]">{{ app()->getLocale() === 'en' ? 'Pain-Free Care' : 'جلسات علاجية خالية من الألم' }}</h5>
                    <p class="text-[11px] text-stone-500">{{ app()->getLocale() === 'en' ? 'Comfortable pediatric & adult dentistry' : 'تخدير رقمي متطور وأسلوب هادئ ومريح' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-lg">⏰</span>
                    <h5 class="text-xs font-bold text-[#3B2A1E]">{{ app()->getLocale() === 'en' ? 'Punctual Appointments' : 'احترام دقيق لمواعيد المرضى' }}</h5>
                    <p class="text-[11px] text-stone-500">{{ app()->getLocale() === 'en' ? 'Minimal waiting time at branches' : 'تقليل وقت الانتظار لأدنى حد ممكن' }}</p>
                </div>
            </div>

        </div>
    </section>
@endsection
