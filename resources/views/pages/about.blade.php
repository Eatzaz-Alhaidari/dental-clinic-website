@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'About Us - Dar Al Uloom Oral & Dental Surgery Clinic' : 'من نحن - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Our Medical Story' : 'نبذة عن العيادة' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                {{ app()->getLocale() === 'en' ? 'About Dar Al Uloom Oral & Dental Surgery Clinic' : 'عيادة دار العلوم لجراحات الفم والأسنان' }}
            </h1>
            <p class="text-stone-300 max-w-2xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'Founded with a vision to provide specialized oral surgery and pain-free dental healthcare across Yemen.' : 'تأسست العيادة لتكون الوجهة التخصصية الأولى في جراحات الفم والأسنان والتقويم وزراعة الأسنان في اليمن، مع التزام صارم بأعلى معايير التعقيم والراحة للمرضى.' }}
            </p>
        </div>
    </section>

    <!-- Main About Content -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider">
                        {{ app()->getLocale() === 'en' ? 'Our Vision & Values' : 'رؤيتنا ورسالتنا' }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#3B2A1E] leading-tight">
                        {{ app()->getLocale() === 'en' ? 'Elevating Oral Surgery & Dental Care Standards in Yemen' : 'نرتقي بمعايير جراحة وطب الأسنان في اليمن' }}
                    </h2>
                    <p class="text-stone-700 text-sm md:text-base leading-relaxed">
                        {{ app()->getLocale() === 'en' ? 'At Dar Al Uloom Clinic, we believe a confident smile and sound oral health change lives. Our clinic combines experienced surgical and medical talent with modern equipment, ensuring every patient receives comprehensive, personalized dental attention.' : 'في عيادة دار العلوم لجراحات الفم والأسنان، نؤمن أن صحة الفم وجمال الابتسامة ركيزتان أساسيتان لجودة الحياة. لذلك حرصنا على استقطاب استشاريين وأخصائيين حاصلين على أعلى الزمالات الطبية في جراحة الفم والأسنان، تقويم الأسنان، وطب أسنان الأطفال، وتجهيز فرعينا في صنعاء وإب بأحدث تقنيات التصوير الرقمي ثلاثي الأبعاد والميكروسكوب الجراحي.' }}
                    </p>
                    <p class="text-stone-700 text-sm md:text-base leading-relaxed">
                        {{ app()->getLocale() === 'en' ? 'From gentle pediatric checkups to complex orthodontic alignments, surgical extractions, and single-visit implants, we provide a complete spectrum of oral healthcare in a calming setting.' : 'نولي عناية فائقة لطب أسنان الأطفال لتنشئة أجيال خالية من الخوف من عيادة الأسنان، كما نوفر قسماً متخصصاً في جراحة الفم والفكين وزراعة الأسنان الفورية وتقويم الأسنان الشفاف (Invisalign) وتجميل الابتسامة.' }}
                    </p>

                    <div class="pt-4 flex flex-wrap gap-4">
                        <x-button variant="gold" :href="route('booking.index')">
                            {{ __('messages.nav.book_appointment') }}
                        </x-button>
                        <x-button variant="brown" :href="route('branches.index')">
                            {{ __('messages.nav.branches') }}
                        </x-button>
                    </div>
                </div>

                <div class="lg:col-span-6 space-y-6">
                    <!-- Authentic Signboard Visual -->
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-[#D4AF37]/60 group relative">
                        <img 
                            src="{{ asset('images/dar-al-uloom-signboard.jpg') }}" 
                            alt="عيادة دار العلوم لجراحات الفم والأسنان"
                            class="w-full h-64 sm:h-72 object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-5">
                            <div>
                                <span class="text-xs font-bold text-[#F0DDA8] block">الهوية الطبية الرسمية</span>
                                <span class="text-lg font-black text-white">عيادة دار العلوم لجراحات الفم والأسنان</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <x-card accent="gold" class="text-center !py-4">
                            <span class="text-3xl font-black text-[#D4AF37] block mb-1">100%</span>
                            <h4 class="font-bold text-[#3B2A1E] text-xs mb-0.5">{{ app()->getLocale() === 'en' ? 'Expert Consultants' : 'استشاريون معتمدون' }}</h4>
                            <p class="text-[11px] text-stone-500">{{ app()->getLocale() === 'en' ? 'Highest credentials' : 'بورد وزمالات دولية مرموقة' }}</p>
                        </x-card>

                        <x-card accent="brown" class="text-center !py-4">
                            <span class="text-3xl font-black text-[#3B2A1E] block mb-1">2</span>
                            <h4 class="font-bold text-[#3B2A1E] text-xs mb-0.5">{{ app()->getLocale() === 'en' ? 'Full Branches' : 'فرعان متكاملان' }}</h4>
                            <p class="text-[11px] text-stone-500">{{ app()->getLocale() === 'en' ? 'Sana\'a & Ibb' : 'صنعاء وإب' }}</p>
                        </x-card>
                    </div>
                </div>

            </div>

            <!-- Pillars of Excellence -->
            <div class="mt-16">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                        {{ app()->getLocale() === 'en' ? 'What Makes Us Different' : 'ركائز الجودة' }}
                    </span>
                    <h3 class="text-3xl font-black text-[#3B2A1E]">
                        {{ app()->getLocale() === 'en' ? 'Our Commitment to Safety & Comfort' : 'التزامنا الدائم بالأمان والراحة' }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <x-card accent="brown">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#3B2A1E] flex items-center justify-center font-black text-xl mb-4">
                            1
                        </div>
                        <h4 class="text-lg font-bold text-[#3B2A1E] mb-2">
                            {{ app()->getLocale() === 'en' ? 'Sterilization Excellence' : 'بروتوكول تعقيم عالمي' }}
                        </h4>
                        <p class="text-sm text-stone-600 leading-relaxed">
                            {{ app()->getLocale() === 'en' ? 'We operate surgical class-B autoclave units and strict single-use disposables for every patient.' : 'نطبق أعلى معايير مكافحة العدوى والتعقيم الحراري للأدوات السنية مع استخدام الأدوات أحادية الاستخدام لكل مريض على حدة.' }}
                        </p>
                    </x-card>

                    <x-card accent="gold">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#D4AF37] flex items-center justify-center font-black text-xl mb-4">
                            2
                        </div>
                        <h4 class="text-lg font-bold text-[#3B2A1E] mb-2">
                            {{ app()->getLocale() === 'en' ? 'Microscope Diagnostics' : 'التشخيص بالمجهر الرقمي' }}
                        </h4>
                        <p class="text-sm text-stone-600 leading-relaxed">
                            {{ app()->getLocale() === 'en' ? 'High-magnification surgical visualization for painless, single-session root canal treatment.' : 'استخدام مجاهر جراحية رقمية توفر تكبيراً فائقاً يتيح الوصول لأدق تفاصيل القنوات العصبية وعلاجها دون ألم.' }}
                        </p>
                    </x-card>

                    <x-card accent="brown">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#3B2A1E] flex items-center justify-center font-black text-xl mb-4">
                            3
                        </div>
                        <h4 class="text-lg font-bold text-[#3B2A1E] mb-2">
                            {{ app()->getLocale() === 'en' ? 'Direct WhatsApp Coordination' : 'تنسيق مباشر عبر الواتساب' }}
                        </h4>
                        <p class="text-sm text-stone-600 leading-relaxed">
                            {{ app()->getLocale() === 'en' ? 'Transparent, instant scheduling connected directly with each branch receptionist.' : 'تواصل فوري مع فريق الاستقبال الخاص بكل فرع لمتابعة الحالات، وتأكيد المواعيد، وتذكير المرضى بجلساتهم.' }}
                        </p>
                    </x-card>
                </div>
            </div>
        </div>
    </section>
@endsection
