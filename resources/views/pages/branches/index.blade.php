@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Our Branches - Dar Al Uloom Clinic' : 'فروعنا في الرياض، جدة، والطائف - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Clinic Network' : 'مواقعنا وعياداتنا' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                {{ app()->getLocale() === 'en' ? 'Our Branches in Riyadh, Jeddah & Taif' : 'فروعنا لخدمتكم في الرياض، جدة، والطائف' }}
            </h1>
            <p class="text-stone-300 max-w-2xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'Visit us in our fully-equipped modern clinics. We are ready to welcome you with world-class dental care.' : 'عيادات مجهزة بأرقى التجهيزات الطبية والتعقيم فائق الدقة، وكادر طبي متكامل في الرياض، جدة، والطائف.' }}
            </p>
        </div>
    </section>

    <!-- Branches Cards & Deep Info -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($branches as $branch)
                    <div class="space-y-6">
                        <x-branch-card :branch="$branch" />

                        <!-- Doctors at this branch -->
                        <x-card accent="gold">
                            <h4 class="text-base font-bold text-[#3B2A1E] mb-3 flex items-center justify-between pb-2 border-b border-amber-100">
                                <span>{{ app()->getLocale() === 'en' ? 'Doctors at ' . $branch->getTranslation('name', app()->getLocale()) : 'الأطباء المتاحون في ' . $branch->getTranslation('name', app()->getLocale()) }}</span>
                                <span class="text-xs font-bold text-[#D4AF37]">{{ $branch->doctors->count() }} {{ app()->getLocale() === 'en' ? 'Doctors' : 'أطباء' }}</span>
                            </h4>

                            <div class="space-y-3">
                                @forelse($branch->doctors as $doctor)
                                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-amber-50/60 border border-amber-200/50">
                                        <div>
                                            <a href="{{ route('doctors.show', $doctor) }}" class="font-bold text-[#3B2A1E] hover:text-[#D4AF37] text-sm block">
                                                {{ $doctor->getTranslation('name', app()->getLocale()) }}
                                            </a>
                                            <span class="text-xs text-stone-500">
                                                {{ $doctor->getTranslation('specialty', app()->getLocale()) }}
                                            </span>
                                        </div>
                                        <a href="{{ route('booking.index') }}" class="text-xs font-bold text-[#D4AF37] hover:underline">
                                            {{ app()->getLocale() === 'en' ? 'Book' : 'حجز' }}
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-xs text-stone-500">{{ app()->getLocale() === 'en' ? 'Doctors schedule updating...' : 'جاري تحديث جدول الأطباء...' }}</p>
                                @endforelse
                            </div>
                        </x-card>
                    </div>
                @endforeach
            </div>

            <!-- Booking Prompt -->
            <div class="text-center max-w-xl mx-auto">
                <h3 class="text-2xl font-black text-[#3B2A1E] mb-4">
                    {{ app()->getLocale() === 'en' ? 'Ready to Visit Us?' : 'جاهز لحجز جلستك في أقرب فرع؟' }}
                </h3>
                <x-button variant="gold" :href="route('booking.index')">
                    {{ __('messages.nav.book_appointment') }}
                </x-button>
            </div>
        </div>
    </section>
@endsection
