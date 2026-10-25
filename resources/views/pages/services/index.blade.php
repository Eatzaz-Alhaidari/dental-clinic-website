@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Dental Services & Specialties - Dar Al Uloom Clinic' : 'خدماتنا الطبية والتخصصية - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Specialized Dental Treatments' : 'التخصصات السنية المتطورة' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                {{ app()->getLocale() === 'en' ? 'Our Dental Services' : 'خدماتنا العلاجية والتجميلية' }}
            </h1>
            <p class="text-stone-300 max-w-2xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'Explore our range of comprehensive dental procedures provided across our Riyadh, Jeddah, and Taif clinics.' : 'نقدم رعاية سنية متكاملة تشمل التقويم، طب أسنان الأطفال، الزراعة، وتجميل الابتسامة بأيدي أطباء استشاريين في فروعنا.' }}
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>

            <!-- Booking Callout Box -->
            <div class="mt-16 bg-white rounded-3xl p-8 border border-amber-200 border-t-8 border-t-[#D4AF37] shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-2xl font-black text-[#3B2A1E] mb-2">
                        {{ app()->getLocale() === 'en' ? 'Need advice on which service is right for you?' : 'هل تحتاج لاستشارة لتحديد الإجراء المناسب لحالتك؟' }}
                    </h3>
                    <p class="text-stone-600 text-sm">
                        {{ app()->getLocale() === 'en' ? 'Book an examination appointment at any of our Riyadh, Jeddah, or Taif branches and receive a tailored dental plan.' : 'احجز موعد كشف واستشارة في أقرب فرع إليك (الرياض، جدة، أو الطائف)، وسيقوم الاستشاري بوضع خطة علاجية مخصصة لك.' }}
                    </p>
                </div>

                <x-button variant="gold" :href="route('booking.index')" class="shrink-0">
                    {{ __('messages.nav.book_appointment') }}
                </x-button>
            </div>
        </div>
    </section>
@endsection
