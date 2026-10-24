<div class="relative">

    @if($isSubmitted)
        <!-- Success Confirmation Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-amber-200 border-t-8 border-t-[#25D366] text-center max-w-2xl mx-auto animate-fade-in">
            <!-- Success Icon Badge -->
            <div class="w-20 h-20 rounded-full bg-emerald-50 text-[#25D366] flex items-center justify-center mx-auto mb-6 shadow-inner border-2 border-emerald-200 relative">
                <span class="absolute inset-0 rounded-full bg-emerald-400 animate-ping opacity-20"></span>
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h3 class="text-2xl sm:text-3xl font-black text-[#3B2A1E] mb-2 font-cairo">
                {{ app()->getLocale() === 'en' ? 'Appointment Request Received Successfully!' : 'تم استلام طلب الموعد بنجاح!' }}
            </h3>

            <p class="text-stone-600 text-sm sm:text-base mb-6 max-w-md mx-auto">
                {{ app()->getLocale() === 'en' 
                    ? 'Your booking is recorded in our clinic system under reference #' . ($submittedData['id'] ?? '') . '. Please complete the confirmation via WhatsApp.' 
                    : 'تم حفظ طلبك برقم مرجعي #' . ($submittedData['id'] ?? '') . ' في نظام العيادة. يرجى المتابعة عبر الواتساب لتثبيت الموعد.' }}
            </p>

            <!-- Booking Summary Details Card -->
            <div class="bg-amber-50/70 rounded-2xl p-5 mb-8 border border-amber-200/80 text-start text-xs sm:text-sm space-y-2.5">
                <div class="flex items-center justify-between pb-2 border-b border-amber-200/60 font-bold text-stone-800">
                    <span>{{ app()->getLocale() === 'en' ? 'Reference Number:' : 'رقم الطلب في النظام:' }}</span>
                    <span class="text-[#D4AF37] font-black font-mono text-base">#{{ $submittedData['id'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Patient Name:' : 'اسم المريض:' }}</span>
                    <span class="font-bold text-[#3B2A1E]">{{ $submittedData['patient_name'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Mobile:' : 'رقم الجوال:' }}</span>
                    <span class="font-bold text-[#3B2A1E]" dir="ltr">{{ $submittedData['phone'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Branch:' : 'الفرع:' }}</span>
                    <span class="font-bold text-[#3B2A1E]">{{ $submittedData['branch'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Service:' : 'الخدمة المطلوبة:' }}</span>
                    <span class="font-bold text-[#3B2A1E]">{{ $submittedData['service'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Doctor:' : 'الطبيب المفضل:' }}</span>
                    <span class="font-bold text-[#3B2A1E]">{{ $submittedData['doctor'] ?? '' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-stone-500 font-semibold">{{ app()->getLocale() === 'en' ? 'Preferred Date & Time:' : 'التاريخ والوقت:' }}</span>
                    <span class="font-bold text-[#3B2A1E]">
                        {{ $submittedData['date'] ?? '' }} ({{ $submittedData['time'] ?? '' }})
                    </span>
                </div>
            </div>

            <!-- Action Buttons: Manual WhatsApp Link & New Booking -->
            <div class="space-y-3">
                <a 
                    href="{{ $whatsappUrl }}" 
                    target="_blank" 
                    id="manual-whatsapp-button"
                    class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 rounded-xl bg-[#25D366] text-white font-black text-base shadow-lg hover:bg-[#20ba59] active:scale-95 transition-all duration-300 group"
                >
                    <svg class="w-6 h-6 fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'en' ? 'Open WhatsApp Chat Now' : 'فتح محادثة واتساب الآن لتأكيد الموعد' }}</span>
                    <span>&rarr;</span>
                </a>

                <button 
                    type="button" 
                    wire:click="resetForm" 
                    class="w-full text-stone-500 hover:text-stone-800 text-xs sm:text-sm font-bold py-2.5 transition-colors"
                >
                    {{ app()->getLocale() === 'en' ? '← Submit Another Booking' : '← طلب حجز موعد جديد آخر' }}
                </button>
            </div>
        </div>

    @else

        <!-- Main Booking Form -->
        <form wire:submit.prevent="submit" class="space-y-8" novalidate>
            @csrf

            <!-- Honeypot anti-spam field (hidden offscreen and aria-hidden) -->
            <div class="hidden" aria-hidden="true">
                <input 
                    type="text" 
                    wire:model="honeypot" 
                    name="website_url_check" 
                    tabindex="-1" 
                    autocomplete="off"
                >
            </div>

            <!-- Rate Limiting Error Banner (if triggered) -->
            @error('rate_limit')
                <div class="p-4 rounded-2xl bg-rose-50 border-2 border-rose-300 text-rose-800 flex items-start gap-3 text-sm">
                    <svg class="w-5 h-5 shrink-0 text-rose-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <!-- ================= STEP 1: CHOOSE BRANCH ================= -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-amber-100 border-t-8 border-t-[#3B2A1E]">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-amber-100">
                    <div class="w-10 h-10 rounded-xl bg-[#3B2A1E] text-[#D4AF37] flex items-center justify-center font-black text-lg">
                        1
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-[#3B2A1E] font-cairo">
                            {{ app()->getLocale() === 'en' ? 'Step 1: Choose Clinic Branch' : 'الخطوة 1: اختر الفرع' }}
                            <span class="text-rose-500">*</span>
                        </h3>
                        <p class="text-xs text-stone-500 font-medium">
                            {{ app()->getLocale() === 'en' ? 'Select Sana\'a or Ibb branch to view available doctors and services' : 'حدد فرع صنعاء أو فرع إب لتحديد الأطباء والخدمات المتاحة فيه' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($branches as $b)
                        @php
                            $isSelected = $branch_id === $b->id;
                            $bName = $b->getTranslation('name', app()->getLocale());
                            $bAddress = $b->getTranslation('address', app()->getLocale());
                            $bHours = $b->getTranslation('working_hours', app()->getLocale());
                        @endphp

                        <div 
                            wire:click="$set('branch_id', {{ $b->id }})"
                            class="cursor-pointer rounded-2xl p-5 border-2 transition-all duration-300 relative {{ $isSelected ? 'border-[#D4AF37] bg-amber-50/80 shadow-md ring-2 ring-[#D4AF37]/30' : 'border-amber-200/60 bg-stone-50/50 hover:bg-amber-50/30 hover:border-amber-300' }}"
                        >
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg {{ $isSelected ? 'bg-[#D4AF37] text-white' : 'bg-stone-200 text-stone-600' }} flex items-center justify-center font-bold text-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h4 class="font-black text-base {{ $isSelected ? 'text-[#3B2A1E]' : 'text-stone-800' }}">
                                        {{ $bName }}
                                    </h4>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center {{ $isSelected ? 'border-[#D4AF37] bg-[#D4AF37]' : 'border-stone-400 bg-white' }}">
                                    @if($isSelected)
                                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <p class="text-xs text-stone-600 mb-2 leading-relaxed">
                                <span class="font-bold text-stone-700">{{ app()->getLocale() === 'en' ? 'Address:' : 'العنوان:' }}</span>
                                {{ $bAddress }}
                            </p>

                            <div class="flex items-center justify-between text-[11px] text-stone-500 pt-2 border-t border-amber-200/50">
                                <span>{{ $bHours }}</span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                    {{ app()->getLocale() === 'en' ? 'Open' : 'متاح للحجز' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @error('branch_id')
                    <p class="mt-3 text-xs text-rose-600 font-bold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- ================= STEP 2: CHOOSE SERVICE & DOCTOR ================= -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-amber-100 border-t-8 border-t-[#D4AF37] {{ !$branch_id ? 'opacity-60 pointer-events-none' : '' }} transition-opacity duration-300">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-amber-100">
                    <div class="w-10 h-10 rounded-xl bg-[#D4AF37] text-white flex items-center justify-center font-black text-lg">
                        2
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-[#3B2A1E] font-cairo">
                            {{ app()->getLocale() === 'en' ? 'Step 2: Dental Service & Doctor' : 'الخطوة 2: الخدمة المطلوبة والطبيب' }}
                        </h3>
                        <p class="text-xs text-stone-500 font-medium">
                            @if(!$branch_id)
                                <span class="text-amber-700 font-bold">⚠️ {{ app()->getLocale() === 'en' ? 'Please select a branch first to unlock services' : 'يرجى اختيار الفرع أولاً لعرض الخدمات والأطباء' }}</span>
                            @else
                                {{ app()->getLocale() === 'en' ? 'Filtered based on your selected branch' : 'محدثة تلقائياً وفقاً للفرع المختار' }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Service Select -->
                    <div>
                        <label for="service_id" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E] mb-2">
                            {{ app()->getLocale() === 'en' ? 'Choose Dental Service' : 'اختر الخدمة المطلوبة' }}
                            <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            id="service_id" 
                            wire:model.live="service_id"
                            class="w-full rounded-xl border border-amber-300 bg-white py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                        >
                            <option value="">{{ app()->getLocale() === 'en' ? '-- Select a Service --' : '-- اختر التخصص أو الخدمة --' }}</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->getTranslation('name', app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>

                        @error('service_id')
                            <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Doctor Select (Optional) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="doctor_id" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E]">
                                {{ app()->getLocale() === 'en' ? 'Choose Doctor / Consultant' : 'اختر الطبيب المعالج' }}
                            </label>
                            <span class="text-[11px] text-stone-500 font-medium bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                {{ app()->getLocale() === 'en' ? 'Optional' : 'اختياري' }}
                            </span>
                        </div>
                        <select 
                            id="doctor_id" 
                            wire:model="doctor_id"
                            class="w-full rounded-xl border border-amber-300 bg-white py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                        >
                            <option value="">{{ app()->getLocale() === 'en' ? '-- Any Available Specialist in this Branch --' : '-- أي استشاري/طبيب متاح في هذا الفرع --' }}</option>
                            @foreach($doctors as $d)
                                <option value="{{ $d->id }}">
                                    {{ $d->getTranslation('name', app()->getLocale()) }} - ({{ $d->getTranslation('specialty', app()->getLocale()) }})
                                </option>
                            @endforeach
                        </select>

                        @error('doctor_id')
                            <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ================= STEP 3: PATIENT INFORMATION & APPOINTMENT TIME ================= -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-amber-100 border-t-8 border-t-[#3B2A1E]">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-amber-100">
                    <div class="w-10 h-10 rounded-xl bg-[#3B2A1E] text-[#D4AF37] flex items-center justify-center font-black text-lg">
                        3
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-[#3B2A1E] font-cairo">
                            {{ app()->getLocale() === 'en' ? 'Step 3: Patient Information & Time' : 'الخطوة 3: بيانات المريض والوقت المفضل' }}
                        </h3>
                        <p class="text-xs text-stone-500 font-medium">
                            {{ app()->getLocale() === 'en' ? 'Provide your contact details so our reception can coordinate your visit' : 'أدخل بيانات التواصل الخاصة بك ليقوم موظف الاستقبال بتأكيد الموعد' }}
                        </p>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Row 1: Name & Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Patient Name -->
                        <div>
                            <label for="patient_name" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E] mb-2">
                                {{ app()->getLocale() === 'en' ? 'Full Patient Name' : 'اسم المريض بالكامل' }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="patient_name" 
                                wire:model="patient_name"
                                placeholder="{{ app()->getLocale() === 'en' ? 'e.g., Mohammed Ahmed' : 'مثال: محمد أحمد علي' }}"
                                class="w-full rounded-xl border border-amber-300 py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                            >
                            @error('patient_name')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mobile Phone Number -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="phone" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E]">
                                    {{ app()->getLocale() === 'en' ? 'Mobile Phone Number' : 'رقم الجوال (واتساب)' }}
                                    <span class="text-rose-500">*</span>
                                </label>
                                <span class="text-[11px] text-stone-500 font-medium">
                                    {{ app()->getLocale() === 'en' ? 'Yemen (77xxxxxxx) or KSA (05xxxxxxxx)' : 'اليمن (77xxxxxxx) أو السعودية (05xxxxxxxx)' }}
                                </span>
                            </div>
                            <div class="relative rounded-xl shadow-xs">
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    wire:model="phone"
                                    dir="ltr"
                                    placeholder="771234567"
                                    class="w-full rounded-xl border border-amber-300 py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all text-start"
                                >
                            </div>
                            @error('phone')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2: Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Preferred Date -->
                        <div>
                            <label for="preferred_date" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E] mb-2">
                                {{ app()->getLocale() === 'en' ? 'Preferred Date' : 'التاريخ المفضل للموعد' }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="preferred_date" 
                                wire:model="preferred_date"
                                min="{{ date('Y-m-d') }}"
                                class="w-full rounded-xl border border-amber-300 py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                            >
                            @error('preferred_date')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preferred Time Slot -->
                        <div>
                            <label for="preferred_time" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E] mb-2">
                                {{ app()->getLocale() === 'en' ? 'Preferred Time Slot' : 'الوقت المفضل للموعد' }}
                                <span class="text-rose-500">*</span>
                            </label>
                            <select 
                                id="preferred_time" 
                                wire:model="preferred_time"
                                class="w-full rounded-xl border border-amber-300 bg-white py-3 px-4 text-stone-800 text-sm font-semibold focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                            >
                                <option value="">{{ app()->getLocale() === 'en' ? '-- Select a Time Slot --' : '-- اختر الفترة المناسبة --' }}</option>
                                @foreach($timeSlots as $periodKey => $period)
                                    <optgroup label="{{ $period['label'] }}">
                                        @foreach($period['slots'] as $slotVal => $slotLabel)
                                            <option value="{{ $slotLabel }}">{{ $slotLabel }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('preferred_time')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 3: Notes (Optional) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="notes" class="block text-xs sm:text-sm font-extrabold text-[#3B2A1E]">
                                {{ app()->getLocale() === 'en' ? 'Notes or Condition Description' : 'ملاحظات إضافية أو وصف الحالة' }}
                            </label>
                            <span class="text-[11px] text-stone-500 font-medium bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                {{ app()->getLocale() === 'en' ? 'Optional' : 'اختياري' }}
                            </span>
                        </div>
                        <textarea 
                            id="notes" 
                            wire:model="notes" 
                            rows="3" 
                            placeholder="{{ app()->getLocale() === 'en' ? 'Describe any current pain, previous dental history, or special requests...' : 'أخبرنا إذا كان هناك ألم حاد، أو تاريخ طبي سابق، أو استفسار محدد...' }}"
                            class="w-full rounded-xl border border-amber-300 py-3 px-4 text-stone-800 text-sm font-medium focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 transition-all shadow-xs"
                        ></textarea>
                        @error('notes')
                            <p class="mt-1.5 text-xs text-rose-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ================= SUBMIT CTA BUTTON ================= -->
            <div class="pt-2 text-center">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="btn-gold !py-4 !px-10 text-base sm:text-lg font-black w-full sm:w-auto shadow-2xl flex items-center justify-center gap-3 mx-auto disabled:opacity-50 disabled:cursor-not-allowed group"
                >
                    <!-- Loading Indicator Spinner -->
                    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>

                    <!-- WhatsApp Icon -->
                    <svg wire:loading.remove class="w-6 h-6 fill-current text-[#25D366] group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                    </svg>

                    <span wire:loading.remove>
                        {{ app()->getLocale() === 'en' ? 'Confirm Request & Open WhatsApp' : 'إرسال طلب الحجز وتأكيد الموعد عبر الواتساب' }}
                    </span>
                    <span wire:loading>
                        {{ app()->getLocale() === 'en' ? 'Recording Request...' : 'جاري تسجيل الطلب وتجهيز الواتساب...' }}
                    </span>
                    <span>&rarr;</span>
                </button>

                <p class="text-xs text-stone-500 font-medium mt-3 flex items-center justify-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>{{ app()->getLocale() === 'en' ? 'Secured with rate limiting & direct WhatsApp verification' : 'محمي بنظام آمن ويتم تحويلك فوراً لواتساب الفرع المختار' }}</span>
                </p>
            </div>
        </form>
    @endif

</div>

<!-- Client-side script to open WhatsApp automatically on submission -->
@script
<script>
    $wire.on('appointment-submitted', (data) => {
        const payload = Array.isArray(data) ? data[0] : data;
        const targetUrl = payload && payload.url ? payload.url : null;
        if (targetUrl) {
            // Attempt to open WhatsApp in a new tab
            const win = window.open(targetUrl, '_blank');
            if (!win || win.closed || typeof win.closed === 'undefined') {
                // If pop-up blocker caught it, user will click the prominent green button on the success card
                console.log('Popup blocked, fallback button available');
            }
        }
    });
</script>
@endscript
