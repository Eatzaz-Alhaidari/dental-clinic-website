@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Our Doctors & Consultants - Dar Al Uloom Clinic' : 'نخبة الأطباء والاستشاريين - عيادة دار العلوم لجراحات الفم والأسنان')

@section('content')
    <!-- Page Header Banner -->
    <section class="bg-gradient-to-r from-[#3B2A1E] via-[#2A1D14] to-[#3B2A1E] text-white py-16 md:py-20 border-b-4 border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-2">
                {{ app()->getLocale() === 'en' ? 'Medical Specialists' : 'الكادر الطبي والاستشاري' }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">
                {{ app()->getLocale() === 'en' ? 'Our Dental Consultants' : 'أطباؤنا ونخبة الاستشاريين' }}
            </h1>
            <p class="text-stone-300 max-w-2xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'Our team features certified specialists across all major dental fields in our Sana\'a and Ibb clinics.' : 'يضم كادرنا استشاريين وأخصائيين حاصلين على الزمالات الدولية والبورد في تقويم الأسنان، أسنان الأطفال، الجراحة، والزراعة.' }}
            </p>
        </div>
    </section>

    <!-- Filter Bar & Doctors Grid -->
    <section class="py-16 md:py-24 bg-[#FFF9EC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filters Form -->
            <div class="bg-white rounded-2xl p-5 mb-12 shadow-sm border border-amber-200/80">
                <form action="{{ route('doctors.index') }}" method="GET" class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-bold text-[#3B2A1E] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'en' ? 'Filter by:' : 'تصفية حسب:' }}</span>
                        </span>

                        <!-- Branch Filter -->
                        <select name="branch_id" onchange="this.form.submit()" class="bg-[#FFF9EC] border border-amber-200 text-[#3B2A1E] text-xs font-bold rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-[#D4AF37] outline-none">
                            <option value="">{{ __('messages.all_branches') }}</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->getTranslation('name', app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Service Filter -->
                        <select name="service_id" onchange="this.form.submit()" class="bg-[#FFF9EC] border border-amber-200 text-[#3B2A1E] text-xs font-bold rounded-xl px-3.5 py-2 focus:ring-2 focus:ring-[#D4AF37] outline-none">
                            <option value="">{{ __('messages.all_services') }}</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->getTranslation('name', app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if(request()->filled('branch_id') || request()->filled('service_id'))
                        <a href="{{ route('doctors.index') }}" class="text-xs font-bold text-rose-600 hover:underline">
                            {{ app()->getLocale() === 'en' ? 'Clear Filters' : 'إعادة تعيين الفلاتر' }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Doctors Grid -->
            @if($doctors->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($doctors as $doctor)
                        <x-doctor-card :doctor="$doctor" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-3xl p-8 border border-amber-200">
                    <p class="text-stone-600 font-bold mb-4">
                        {{ app()->getLocale() === 'en' ? 'No doctors match the selected filter.' : 'لم يتم العثور على أطباء يطابقون خيارات الفلترة المحددة.' }}
                    </p>
                    <a href="{{ route('doctors.index') }}" class="btn-gold !text-xs">
                        {{ app()->getLocale() === 'en' ? 'View All Doctors' : 'عرض كافة الأطباء' }}
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
