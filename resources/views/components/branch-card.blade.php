@props([
    'branch',
])

@php
$locale = app()->getLocale();
$name = $branch->getTranslation('name', $locale);
$address = $branch->getTranslation('address', $locale);
$hours = $branch->getTranslation('working_hours', $locale);
$cleanWa = $branch->clean_whatsapp_number;
$waMsg = rawurlencode("مرحباً بكم في {$name}، أود الاستفسار عن المواعيد والخدمات المتاحة.");
@endphp

<x-card accent="brown" class="flex flex-col justify-between">
    <div>
        <div class="flex items-start justify-between mb-4">
            <div>
                <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">
                    {{ $locale === 'en' ? 'Clinic Branch' : 'فرع العيادة الرسمي' }}
                </span>
                <h3 class="text-2xl font-black text-[#3B2A1E]">
                    {{ $name }}
                </h3>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $branch->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                <span class="w-2 h-2 rounded-full {{ $branch->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                {{ $branch->is_active ? ($locale === 'en' ? 'Active' : 'مفتوح لاستقبال المرضى') : ($locale === 'en' ? 'Closed' : 'مغلق') }}
            </span>
        </div>

        <div class="space-y-3.5 mb-6 text-sm text-stone-700">
            <!-- Address -->
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-[#3B2A1E] flex items-center justify-center shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ $locale === 'en' ? 'Address' : 'العنوان' }}</span>
                    <span>{{ $address }}</span>
                </div>
            </div>

            <!-- Working Hours -->
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-[#3B2A1E] flex items-center justify-center shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ $locale === 'en' ? 'Working Hours' : 'أوقات الدوام' }}</span>
                    <span>{{ $hours }}</span>
                </div>
            </div>

            <!-- Phone & WhatsApp -->
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-[#3B2A1E] flex items-center justify-center shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-[#3B2A1E] block text-xs mb-0.5">{{ $locale === 'en' ? 'Contact Numbers' : 'أرقام التواصل' }}</span>
                    <div class="flex flex-wrap gap-2 text-xs">
                        <a href="tel:{{ $branch->phone }}" class="hover:text-[#D4AF37] font-semibold" dir="ltr">{{ $branch->phone }}</a>
                        <span>•</span>
                        <a href="https://wa.me/{{ $cleanWa }}?text={{ $waMsg }}" target="_blank" class="hover:text-[#25D366] font-semibold text-emerald-700" dir="ltr">WhatsApp: {{ $branch->whatsapp_number }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-4 border-t border-amber-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-auto">
        <a href="https://wa.me/{{ $cleanWa }}?text={{ $waMsg }}" target="_blank" class="btn-whatsapp !px-4 !py-2.5 !text-xs !rounded-xl text-center">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
            </svg>
            <span>{{ $locale === 'en' ? 'Chat on WhatsApp' : 'محادثة واتساب الفرع' }}</span>
        </a>

        @if($branch->map_url)
            <a href="{{ $branch->map_url }}" target="_blank" class="btn-gold !px-4 !py-2.5 !text-xs !rounded-xl text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                </svg>
                <span>{{ $locale === 'en' ? 'Google Maps' : 'موقع الفرع بالخريطة' }}</span>
            </a>
        @endif
    </div>
</x-card>
