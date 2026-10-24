@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Home - Dar Al Uloom Oral & Dental Surgery Clinic' : 'الرئيسية - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')

    <!-- Top Services Icon Ribbon Strip -->
    @if(isset($services) && $services->isNotEmpty())
        <x-service-strip :services="$services" />
    @endif

    <!-- Hero Section -->
    <section class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-b from-amber-50/50 via-[#FFF9EC] to-[#FFF9EC]">
        <!-- Decorative Ambient Blobs -->
        <div class="absolute top-0 start-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-200/30 via-transparent to-transparent -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Content -->
                <div class="lg:col-span-7 text-center lg:text-start">
                    <!-- Top Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-amber-200/80 shadow-xs mb-6">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#D4AF37] animate-ping"></span>
                        <span class="text-xs font-bold text-[#3B2A1E]">
                            {{ app()->getLocale() === 'en' ? 'Leading Oral & Dental Surgery Clinics in Sana\'a & Ibb' : 'العيادة التخصصية الرائدة لجراحات الفم والأسنان في صنعاء وإب' }}
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#3B2A1E] tracking-tight leading-[1.2] mb-6">
                        @if(app()->getLocale() === 'en')
                            World-Class Care For Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#B89326]">Perfect Smile</span>
                        @else
                            ابتسامتكم تبدأ هنا.. رعاية استشارية <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#B89326]">متكاملة لجميع أفراد العائلة</span>
                        @endif
                    </h1>

                    <p class="text-base sm:text-lg text-stone-600 leading-relaxed max-w-2xl mx-auto lg:mx-0 mb-8 font-medium">
                        @if(app()->getLocale() === 'en')
                            Equipped with surgical microscopes, digital 3D smile design, and painless pediatric dentistry across our Sana'a and Ibb clinics.
                        @else
                            نقدم أحدث علاجات تقويم الأسنان الشفاف، وطب أسنان الأطفال بأجواء مريحة وخالية من الألم، وزراعة الأسنان الفورية وتجميل الابتسامة بإشراف نخبة من الاستشاريين المعتمدين.
                        @endif
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-10">
                        <x-button variant="gold" :href="route('booking.index')" class="w-full sm:w-auto !py-3.5 !px-8 text-base">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ __('messages.nav.book_appointment') }}</span>
                        </x-button>

                        <x-button variant="brown" :href="route('branches.index')" class="w-full sm:w-auto !py-3.5 !px-7 text-base">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'en' ? 'Explore Branches' : 'استكشف فروعنا' }}</span>
                        </x-button>
                    </div>

                    <!-- Trust Stats Ribbon -->
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-amber-200/60 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-[#3B2A1E]">100%</span>
                            <span class="text-xs text-stone-500 font-bold">{{ app()->getLocale() === 'en' ? 'Certified Doctors' : 'استشاريون معتمدون' }}</span>
                        </div>
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-[#D4AF37]">2</span>
                            <span class="text-xs text-stone-500 font-bold">{{ app()->getLocale() === 'en' ? 'Full Branches (Sana\'a & Ibb)' : 'فرعان (صنعاء وإب)' }}</span>
                        </div>
                        <div>
                            <span class="block text-2xl sm:text-3xl font-black text-[#3B2A1E]">15+</span>
                            <span class="text-xs text-stone-500 font-bold">{{ app()->getLocale() === 'en' ? 'Years of Excellence' : 'عاماً من الخبرة والتميز' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual Card Graphic (Featuring Real Signboard & Identity) -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Card with Dark Top Border & Gold Accents -->
                        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-2xl border border-amber-100 border-t-8 border-t-[#3B2A1E] relative z-10 overflow-hidden">
                            
                            <!-- Card Header with Clinic Logo -->
                            <div class="flex items-center justify-between mb-5 pb-4 border-b border-amber-100">
                                <x-clinic-logo size="sm" />
                                <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-200 shrink-0">
                                    {{ app()->getLocale() === 'en' ? 'Open Now' : 'نستقبلكم الآن' }}
                                </span>
                            </div>

                            <!-- Clinic Real Signboard Photo Showcase -->
                            <div class="relative rounded-2xl overflow-hidden border-2 border-[#D4AF37]/50 shadow-md mb-5 group">
                                <img 
                                    src="{{ asset('images/dar-al-uloom-signboard.jpg') }}" 
                                    alt="عيادة دار العلوم لجراحات الفم والأسنان" 
                                    class="w-full h-48 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-3.5">
                                    <div class="text-white">
                                        <span class="text-[11px] font-bold text-[#F0DDA8] block">
                                            {{ app()->getLocale() === 'en' ? 'Official Clinic Signboard & Brand' : 'الهوية الطبية الرسمية المعتمدة' }}
                                        </span>
                                        <span class="text-xs sm:text-sm font-black text-white">
                                            {{ __('messages.clinic_name') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Specialty Highlights -->
                            <div class="space-y-3 mb-6">
                                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/60 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#3B2A1E] text-[#D4AF37] flex items-center justify-center shrink-0 text-xs font-black">
                                        ✦
                                    </div>
                                    <div class="text-xs">
                                        <span class="font-extrabold text-[#3B2A1E] block">{{ app()->getLocale() === 'en' ? 'Oral & Maxillofacial Surgeries' : 'جراحات الفم والأسنان المتقدمة والفكين' }}</span>
                                        <span class="text-stone-500 font-medium">{{ app()->getLocale() === 'en' ? 'Surgical extractions, bone grafting & implants' : 'خلع جراحي دقيق، زراعة عظم، وزراعة فورية' }}</span>
                                    </div>
                                </div>

                                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/60 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#D4AF37] text-white flex items-center justify-center shrink-0 text-xs font-black">
                                        ★
                                    </div>
                                    <div class="text-xs">
                                        <span class="font-extrabold text-[#3B2A1E] block">{{ app()->getLocale() === 'en' ? 'Orthodontics & Pediatric Dentistry' : 'تقويم الأسنان وطب أسنان الأطفال' }}</span>
                                        <span class="text-stone-500 font-medium">{{ app()->getLocale() === 'en' ? 'Digital aligners & child-friendly painless care' : 'تقويم تجميلي شفاف وعلاج أطفال بدون ألم' }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('booking.index') }}" class="btn-gold w-full text-center">
                                {{ __('messages.nav.book_appointment') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Services Section (From Database) -->
    <section class="py-16 md:py-24 bg-white border-y border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                        {{ app()->getLocale() === 'en' ? 'Clinical Specialties' : 'تخصصات العيادة' }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#3B2A1E]">
                        {{ app()->getLocale() === 'en' ? 'Comprehensive Dental Services' : 'خدماتنا الطبية المتكاملة' }}
                    </h2>
                </div>

                <a href="{{ route('services.index') }}" class="text-sm font-bold text-[#3B2A1E] hover:text-[#D4AF37] inline-flex items-center gap-1 group transition-colors">
                    <span>{{ app()->getLocale() === 'en' ? 'Explore all services' : 'استعراض كافة الخدمات السنية' }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Branches Section (Sana'a & Ibb From Database) -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                    {{ app()->getLocale() === 'en' ? 'Our Clinic Locations' : 'مواقعنا الرسمية' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-[#3B2A1E] mb-4">
                    {{ app()->getLocale() === 'en' ? 'Visit Us in Sana\'a & Ibb' : 'فروعنا في صنعاء وإب' }}
                </h2>
                <p class="text-stone-600 text-sm md:text-base">
                    {{ app()->getLocale() === 'en' ? 'Both branches are fully equipped with state-of-the-art diagnostic instruments and welcoming environments.' : 'عيادات مجهزة بأحدث أجهزة التصوير ثلاثي الأبعاد والتعقيم الجراحي، مع كادر استقبال واستشاري متفرغ لخدمتكم.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @foreach($branches as $branch)
                    <x-branch-card :branch="$branch" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Doctors Showcase Section (From Database) -->
    <section class="py-16 md:py-24 bg-white border-t border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                        {{ app()->getLocale() === 'en' ? 'Medical Team' : 'فريقنا الطبي' }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#3B2A1E]">
                        {{ app()->getLocale() === 'en' ? 'Meet Our Certified Specialists' : 'نخبة الأطباء والاستشاريين' }}
                    </h2>
                </div>

                <a href="{{ route('doctors.index') }}" class="text-sm font-bold text-[#3B2A1E] hover:text-[#D4AF37] inline-flex items-center gap-1 group transition-colors">
                    <span>{{ app()->getLocale() === 'en' ? 'View all doctors' : 'استعراض كافة أطباء العيادة' }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $doctor)
                    <x-doctor-card :doctor="$doctor" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Quality Pillars -->
    <section class="py-16 md:py-24 bg-[#3B2A1E] text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                    {{ app()->getLocale() === 'en' ? 'Excellence in Dental Care' : 'معايير الجودة والتميز' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mb-4">
                    {{ app()->getLocale() === 'en' ? 'Why Patients Trust Dar Al Uloom Clinic' : 'لماذا يختار مرضانا عيادة دار العلوم؟' }}
                </h2>
                <p class="text-stone-300 text-sm md:text-base">
                    {{ app()->getLocale() === 'en' ? 'We combine medical expertise with compassionate patient comfort.' : 'نلتزم بأعلى بروتوكولات التعقيم العالمية وأحدث التقنيات الرقمية لنضمن تجربة علاجية استثنائية.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#D4AF37] text-[#3B2A1E] flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-lg">
                        ✓
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">{{ app()->getLocale() === 'en' ? 'Microscopic Precision' : 'علاج بالمجهر الجراحي' }}</h4>
                    <p class="text-xs text-stone-300 leading-relaxed">{{ app()->getLocale() === 'en' ? 'Ultra precision endodontics and restorations.' : 'دقة متناهية في علاج عصب الأسنان وقنوات الجذور المعقدة.' }}</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#D4AF37] text-[#3B2A1E] flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-lg">
                        ★
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">{{ app()->getLocale() === 'en' ? 'Child-Friendly Clinic' : 'أطباء أسنان أطفال ودودون' }}</h4>
                    <p class="text-xs text-stone-300 leading-relaxed">{{ app()->getLocale() === 'en' ? 'Zero fear environment for children.' : 'جلسات علاجية مرحة وخالية من الخوف أو الألم للأطفال.' }}</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#D4AF37] text-[#3B2A1E] flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-lg">
                        ❖
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">{{ app()->getLocale() === 'en' ? 'Sterilization Safety' : 'أعلى معايير التعقيم' }}</h4>
                    <p class="text-xs text-stone-300 leading-relaxed">{{ app()->getLocale() === 'en' ? 'Hospital-grade autoclaves and disposable kits.' : 'تعقيم حراري وميكانيكي متطور بنظام الأوتوكلاف الفئوي B.' }}</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 transition-colors">
                    <div class="w-14 h-14 rounded-2xl bg-[#D4AF37] text-[#3B2A1E] flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-lg">
                        ♥
                    </div>
                    <h4 class="text-lg font-bold text-white mb-2">{{ app()->getLocale() === 'en' ? 'Transparent WhatsApp' : 'تأكيد فوري عبر الواتساب' }}</h4>
                    <p class="text-xs text-stone-300 leading-relaxed">{{ app()->getLocale() === 'en' ? 'Seamless communication directly with branch staff.' : 'تأكيد مباشر لمواعيدكم وتواصل مستمر مع إدارة الفرع.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action Booking Banner -->
    <section class="py-16 bg-[#FFF9EC]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#3B2A1E] via-[#2D1F15] to-[#3B2A1E] rounded-3xl p-8 sm:p-12 text-white text-center shadow-2xl border-4 border-[#D4AF37] relative overflow-hidden">
                <div class="relative z-10 max-w-2xl mx-auto">
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-black mb-4 leading-tight">
                        {{ app()->getLocale() === 'en' ? 'Ready to Transform Your Smile?' : 'هل أنت مستعد لبدء رحلة ابتسامتك المثالية؟' }}
                    </h3>
                    <p class="text-stone-300 text-sm sm:text-base mb-8">
                        {{ app()->getLocale() === 'en' ? 'Book your consultation online in under a minute and confirm directly via branch WhatsApp.' : 'اختر الفرع الأقرب إليك (صنعاء أو إب) والخدمة المناسبة وسيصل طلبك فوراً لفريق الاستقبال.' }}
                    </p>
                    <x-button variant="gold" :href="route('booking.index')" class="!py-4 !px-10 text-base">
                        {{ __('messages.nav.book_appointment') }}
                    </x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
