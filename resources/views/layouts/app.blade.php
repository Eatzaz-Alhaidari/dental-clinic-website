<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" id="meta-viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.clinic_name')) | {{ __('messages.clinic_name') }}</title>
    <meta name="description" content="@yield('meta_description', 'عيادة دار العلوم لجراحات الفم والأسنان في صنعاء وإب - نخبة الاستشاريين في جراحة الفم والأسنان، زراعة الأسنان، تقويم الأسنان، وطب أسنان الأطفال.')">
    <meta name="robots" content="index, follow">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

    <!-- OpenGraph / Social -->
    <meta property="og:title" content="@yield('title', __('messages.clinic_name'))">
    <meta property="og:description" content="@yield('meta_description', 'عيادة دار العلوم لجراحات الفم والأسنان - أحدث التقنيات الطبية في فرعي صنعاء وإب.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/dar-al-uloom-signboard.jpg') }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_AR' : 'en_US' }}">

    <!-- Google Fonts: Tajawal & Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Early script to apply stored View Mode (Mobile / Desktop) without FOUC -->
    <script>
        (function() {
            const savedMode = localStorage.getItem('clinic_view_mode') || 'auto';
            if (savedMode === 'mobile') {
                document.documentElement.classList.add('mode-mobile');
            } else if (savedMode === 'desktop') {
                document.documentElement.classList.add('mode-desktop');
                const viewport = document.getElementById('meta-viewport');
                if (viewport) viewport.setAttribute('content', 'width=1200');
            }
        })();
    </script>

    <style>
        /* Mobile simulation view wrapper styles */
        html.mode-mobile body {
            background-color: #261A13;
            padding: 1rem 0;
            display: flex;
            justify-content: center;
        }
        html.mode-mobile #app-container {
            max-width: 430px;
            width: 100%;
            margin: 0 auto;
            min-height: 100vh;
            background-color: #FFF9EC;
            border-radius: 2.5rem;
            box-shadow: 0 25px 60px -15px rgba(0,0,0,0.7), 0 0 0 10px #3B2A1E, 0 0 0 12px #D4AF37;
            overflow-x: hidden;
            position: relative;
        }
        /* Desktop forced mode styles */
        html.mode-desktop #app-container {
            min-width: 1200px;
            width: 100%;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #FFF9EC;
        }
        ::-webkit-scrollbar-thumb {
            background: #D4AF37;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #B89326;
        }
    </style>
</head>
<body class="bg-[#FFF9EC] text-[#3B2A1E] font-sans antialiased selection:bg-[#D4AF37] selection:text-white">

    <div id="app-container" class="flex flex-col min-h-screen">

        <!-- Top Header & Announcement Bar -->
        <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-amber-200/60 shadow-xs transition-all duration-300">
            <!-- Top Micro Bar -->
            <div class="bg-[#3B2A1E] text-stone-200 text-xs py-1.5 px-4 sm:px-6 lg:px-8 border-b border-amber-500/20">
                <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>{{ app()->getLocale() === 'en' ? 'Open Today in Sana\'a & Ibb' : 'نستقبلكم يومياً في فرعي صنعاء وإب' }}</span>
                        </span>
                        <span class="hidden md:inline text-amber-500/40">•</span>
                        <span class="hidden md:flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span dir="ltr">+967 1 445566</span>
                        </span>
                    </div>

                    <!-- Header Controls: View Switcher (Mobile/Laptop) & Language Switcher -->
                    <div class="flex items-center gap-3">
                        <!-- View Switcher -->
                        <div class="flex items-center bg-black/30 rounded-lg p-0.5 border border-white/10" title="{{ app()->getLocale() === 'en' ? 'Switch Display View' : 'مبدّل وضع العرض' }}">
                            <!-- Mobile View Button -->
                            <button id="btn-view-mobile" onclick="setViewMode('mobile')" class="p-1 rounded text-stone-300 hover:text-white hover:bg-white/10 transition-colors" title="{{ app()->getLocale() === 'en' ? 'Mobile View (430px)' : 'وضع شاشة الجوال (430px)' }}">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                                </svg>
                            </button>

                            <!-- Laptop/Desktop View Button -->
                            <button id="btn-view-desktop" onclick="setViewMode('desktop')" class="p-1 rounded text-stone-300 hover:text-white hover:bg-white/10 transition-colors" title="{{ app()->getLocale() === 'en' ? 'Desktop View (1200px)' : 'وضع شاشة اللابتوب الكاملة (1200px)' }}">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                    <line x1="8" y1="21" x2="16" y2="21"/>
                                    <line x1="12" y1="17" x2="12" y2="21"/>
                                </svg>
                            </button>

                            <!-- Auto/Reset Button -->
                            <button id="btn-view-auto" onclick="setViewMode('auto')" class="p-1 rounded text-stone-300 hover:text-white hover:bg-white/10 transition-colors" title="{{ app()->getLocale() === 'en' ? 'Auto Responsive View' : 'الوضع المتجاوب التلقائي' }}">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Language Switcher -->
                        <div class="border-s border-white/20 ps-2">
                            @if(app()->getLocale() === 'ar')
                                <a href="{{ route('language.switch', 'en') }}" class="font-bold text-[#F0DDA8] hover:text-white transition-colors flex items-center gap-1">
                                    <span>English</span>
                                    <span class="text-[10px] bg-white/10 px-1.5 py-0.5 rounded">EN</span>
                                </a>
                            @else
                                <a href="{{ route('language.switch', 'ar') }}" class="font-bold text-[#F0DDA8] hover:text-white transition-colors flex items-center gap-1 font-cairo">
                                    <span>العربية</span>
                                    <span class="text-[10px] bg-white/10 px-1.5 py-0.5 rounded">AR</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation Bar -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    
                    <!-- Logo & Brand Identity -->
                    <a href="{{ route('home') }}" class="flex items-center">
                        <x-clinic-logo size="md" />
                    </a>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden lg:flex items-center gap-1 font-bold text-stone-700">
                        <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('home') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.home') }}
                        </a>
                        <a href="{{ route('about') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('about') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.about') }}
                        </a>
                        <a href="{{ route('services.index') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('services.*') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.services') }}
                        </a>
                        <a href="{{ route('doctors.index') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('doctors.*') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.doctors') }}
                        </a>
                        <a href="{{ route('branches.index') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('branches.*') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.branches') }}
                        </a>
                        <a href="{{ route('contact') }}" class="px-3.5 py-2 rounded-xl transition-colors {{ request()->routeIs('contact') ? 'text-[#D4AF37] bg-amber-50 font-extrabold' : 'hover:text-[#D4AF37] hover:bg-stone-50' }}">
                            {{ __('messages.nav.contact') }}
                        </a>
                    </nav>

                    <!-- Header CTA Action Buttons -->
                    <div class="hidden sm:flex items-center gap-3">
                        <x-button variant="gold" :href="route('booking.index')">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ __('messages.nav.book_appointment') }}</span>
                        </x-button>
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <div class="flex items-center lg:hidden">
                        <button type="button" onclick="toggleMobileMenu()" class="p-2.5 rounded-xl text-[#3B2A1E] hover:bg-amber-50 transition-colors" aria-label="Toggle Navigation">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Drawer (Off-Canvas) -->
        <div id="mobile-menu-drawer" class="fixed inset-0 z-50 pointer-events-none opacity-0 invisible transition-all duration-300">
            <!-- Backdrop -->
            <div id="mobile-menu-backdrop" onclick="toggleMobileMenu()" class="absolute inset-0 bg-[#3B2A1E]/60 backdrop-blur-xs transition-opacity duration-300"></div>

            <!-- Drawer Content Panel -->
            <div id="mobile-menu-panel" class="absolute inset-y-0 end-0 max-w-xs w-full bg-[#FFF9EC] shadow-2xl p-6 flex flex-col justify-between overflow-y-auto pointer-events-auto border-s border-amber-200 transform ltr:translate-x-full rtl:-translate-x-full transition-transform duration-300 ease-in-out">
                <div>
                    <!-- Drawer Header -->
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-amber-200">
                        <x-clinic-logo size="sm" />
                        <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-stone-500 hover:text-stone-800">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Nav Links -->
                    <div class="flex flex-col space-y-2 font-bold text-stone-800">
                        <a href="{{ route('home') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('home') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.home') }}
                        </a>
                        <a href="{{ route('about') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('about') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.about') }}
                        </a>
                        <a href="{{ route('services.index') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('services.*') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.services') }}
                        </a>
                        <a href="{{ route('doctors.index') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('doctors.*') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.doctors') }}
                        </a>
                        <a href="{{ route('branches.index') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('branches.*') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.branches') }}
                        </a>
                        <a href="{{ route('contact') }}" onclick="toggleMobileMenu()" class="p-3 rounded-xl hover:bg-white hover:text-[#D4AF37] transition-colors {{ request()->routeIs('contact') ? 'bg-white text-[#D4AF37] shadow-xs' : '' }}">
                            {{ __('messages.nav.contact') }}
                        </a>
                    </div>
                </div>

                <!-- Drawer Footer & Actions -->
                <div class="pt-6 border-t border-amber-200 space-y-3">
                    <x-button variant="gold" :href="route('booking.index')" class="w-full text-center">
                        {{ __('messages.nav.book_appointment') }}
                    </x-button>

                    <div class="flex items-center justify-between text-xs font-semibold text-stone-600 pt-2">
                        <span>{{ app()->getLocale() === 'en' ? 'Language:' : 'اللغة:' }}</span>
                        @if(app()->getLocale() === 'ar')
                            <a href="{{ route('language.switch', 'en') }}" class="font-bold text-[#3B2A1E] underline">English</a>
                        @else
                            <a href="{{ route('language.switch', 'ar') }}" class="font-bold text-[#3B2A1E] underline font-cairo">العربية</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Floating Action Buttons (WhatsApp & Quick Booking) -->
        <div class="fixed bottom-6 end-6 z-40 flex flex-col items-end gap-3 pointer-events-auto">
            <!-- Floating Quick Booking Button -->
            <a href="{{ route('booking.index') }}" class="btn-gold !p-3.5 !rounded-full sm:!rounded-full shadow-2xl group flex items-center gap-2" title="{{ __('messages.nav.book_appointment') }}">
                <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="max-w-0 overflow-hidden whitespace-nowrap group-hover:max-w-xs transition-all duration-300 font-bold text-sm hidden sm:inline">
                    {{ __('messages.nav.book_appointment') }}
                </span>
            </a>

            <!-- Floating WhatsApp Button -->
            <a href="https://wa.me/967771234567?text={{ rawurlencode('مرحباً بكم، أود الاستفسار عن حجز موعد في عيادة دار العلوم لجراحات الفم والأسنان.') }}" target="_blank" class="w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 relative group" title="{{ __('messages.whatsapp') }}">
                <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-25"></span>
                <svg class="w-7 h-7 fill-current relative z-10" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
                </svg>
            </a>
        </div>

        <!-- Footer -->
        <footer class="bg-[#3B2A1E] text-stone-300 pt-16 pb-8 border-t-4 border-[#D4AF37]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                    
                    <!-- Col 1: Brand & Bio -->
                    <div>
                        <div class="mb-4">
                            <x-clinic-logo size="md" :inverted="true" />
                        </div>
                        <p class="text-sm text-stone-300 leading-relaxed mb-6">
                            {{ __('messages.footer.about_text') }}
                        </p>
                        <div class="flex items-center gap-3 text-sm">
                            <a href="{{ route('filament.admin.auth.login') }}" class="inline-flex items-center gap-1.5 text-xs text-[#F0DDA8] hover:text-white bg-white/10 px-3 py-1.5 rounded-lg border border-white/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                <span>{{ __('messages.nav.admin_panel') }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- Col 2: Quick Links -->
                    <div>
                        <h4 class="text-base font-bold text-white mb-4 border-b border-[#D4AF37]/30 pb-2">
                            {{ __('messages.footer.quick_links') }}
                        </h4>
                        <ul class="space-y-2.5 text-sm font-medium">
                            <li><a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.nav.home') }}</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.nav.about') }}</a></li>
                            <li><a href="{{ route('services.index') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.nav.services') }}</a></li>
                            <li><a href="{{ route('doctors.index') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.nav.doctors') }}</a></li>
                            <li><a href="{{ route('branches.index') }}" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.nav.branches') }}</a></li>
                            <li><a href="{{ route('booking.index') }}" class="hover:text-[#D4AF37] transition-colors text-[#F0DDA8]">{{ __('messages.nav.book_appointment') }}</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Sana'a Branch -->
                    <div>
                        <h4 class="text-base font-bold text-white mb-4 border-b border-[#D4AF37]/30 pb-2">
                            {{ app()->getLocale() === 'en' ? 'Sana\'a Branch' : 'فرع صنعاء' }}
                        </h4>
                        <p class="text-xs text-stone-300 leading-relaxed mb-3">
                            {{ app()->getLocale() === 'en' ? 'South Sixty St, Hadda Intersection, Near Al-Rowaishan Tower' : 'شارع الستين الجنوبي، تقاطع حدة، جوار برج الرويشان' }}
                        </p>
                        <p class="text-xs text-amber-200/80 mb-2">
                            <span class="font-bold text-white">{{ __('messages.phone') }}:</span> <span dir="ltr">+967 1 445566</span>
                        </p>
                        <p class="text-xs text-amber-200/80 mb-4">
                            <span class="font-bold text-white">{{ __('messages.whatsapp') }}:</span> <span dir="ltr">967771234567</span>
                        </p>
                        <a href="https://wa.me/967771234567" target="_blank" class="text-xs text-[#25D366] hover:underline font-bold inline-flex items-center gap-1">
                            <span>{{ app()->getLocale() === 'en' ? 'Chat with Sana\'a Branch' : 'واتساب فرع صنعاء' }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <!-- Col 4: Ibb Branch -->
                    <div>
                        <h4 class="text-base font-bold text-white mb-4 border-b border-[#D4AF37]/30 pb-2">
                            {{ app()->getLocale() === 'en' ? 'Ibb Branch' : 'فرع إب' }}
                        </h4>
                        <p class="text-xs text-stone-300 leading-relaxed mb-3">
                            {{ app()->getLocale() === 'en' ? 'Al-Udayn Street, Elite Medical Complex, Near Al-Ma\'ayen' : 'شارع العدين، مجمع النخبة الطبي، بالقرب من جولة المعاين' }}
                        </p>
                        <p class="text-xs text-amber-200/80 mb-2">
                            <span class="font-bold text-white">{{ __('messages.phone') }}:</span> <span dir="ltr">+967 4 223344</span>
                        </p>
                        <p class="text-xs text-amber-200/80 mb-4">
                            <span class="font-bold text-white">{{ __('messages.whatsapp') }}:</span> <span dir="ltr">967739876543</span>
                        </p>
                        <a href="https://wa.me/967739876543" target="_blank" class="text-xs text-[#25D366] hover:underline font-bold inline-flex items-center gap-1">
                            <span>{{ app()->getLocale() === 'en' ? 'Chat with Ibb Branch' : 'واتساب فرع إب' }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                </div>

                <!-- Copyright -->
                <div class="pt-8 border-t border-white/10 text-center text-xs text-stone-400">
                    <p>{{ __('messages.footer.rights', ['year' => date('Y')]) }}</p>
                </div>
            </div>
        </footer>

    </div>

    <!-- JavaScript for Mobile Menu & View Switcher -->
    <script>
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-menu-drawer');
            const panel = document.getElementById('mobile-menu-panel');
            const isOpen = !drawer.classList.contains('invisible');

            if (isOpen) {
                // Close
                drawer.classList.add('opacity-0', 'invisible', 'pointer-events-none');
                panel.classList.remove('translate-x-0');
                panel.classList.add('ltr:translate-x-full', 'rtl:-translate-x-full');
                document.body.style.overflow = '';
            } else {
                // Open
                drawer.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
                panel.classList.remove('ltr:translate-x-full', 'rtl:-translate-x-full');
                panel.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            }
        }

        // View Switcher logic (Mobile 430px / Desktop 1200px / Auto responsive)
        function setViewMode(mode) {
            localStorage.setItem('clinic_view_mode', mode);
            applyViewMode(mode);
        }

        function applyViewMode(mode) {
            const html = document.documentElement;
            const viewport = document.getElementById('meta-viewport');
            
            // Clear existing mode classes
            html.classList.remove('mode-mobile', 'mode-desktop');

            // Reset buttons highlight
            document.querySelectorAll('#btn-view-mobile, #btn-view-desktop, #btn-view-auto').forEach(btn => {
                btn.classList.remove('bg-[#D4AF37]', 'text-[#3B2A1E]');
                btn.classList.add('text-stone-300');
            });

            if (mode === 'mobile') {
                html.classList.add('mode-mobile');
                if (viewport) viewport.setAttribute('content', 'width=device-width, initial-scale=1.0');
                const btn = document.getElementById('btn-view-mobile');
                if (btn) {
                    btn.classList.add('bg-[#D4AF37]', 'text-[#3B2A1E]');
                    btn.classList.remove('text-stone-300');
                }
            } else if (mode === 'desktop') {
                html.classList.add('mode-desktop');
                if (viewport) viewport.setAttribute('content', 'width=1200');
                const btn = document.getElementById('btn-view-desktop');
                if (btn) {
                    btn.classList.add('bg-[#D4AF37]', 'text-[#3B2A1E]');
                    btn.classList.remove('text-stone-300');
                }
            } else {
                // Auto / responsive
                if (viewport) viewport.setAttribute('content', 'width=device-width, initial-scale=1.0');
                const btn = document.getElementById('btn-view-auto');
                if (btn) {
                    btn.classList.add('bg-[#D4AF37]', 'text-[#3B2A1E]');
                    btn.classList.remove('text-stone-300');
                }
            }
        }

        // Apply on load
        document.addEventListener('DOMContentLoaded', function() {
            const currentMode = localStorage.getItem('clinic_view_mode') || 'auto';
            applyViewMode(currentMode);
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
