<!DOCTYPE html>
<html lang="ms" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="@yield('meta_description', 'Sakeenah Medicare (SKMED) - Pusat Psikologi & Kesejahteraan Minda di Cyberjaya. Khidmat terapi klinikal, kaunseling, penilaian ADHD/Autisme dan sokongan emosi.')">
    <title>@yield('title', 'Sakeenah Medicare | Pusat Psikologi & Kesejahteraan Emosi Cyberjaya')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FBFBFB] text-neutral-800 font-sans antialiased selection:bg-[#52B788]/20 selection:text-[#2D6A4F] flex flex-col min-h-screen overflow-x-hidden">

    {{-- Crisis Hotline Top Banner --}}
    <aside aria-label="Crisis Helpline" class="bg-emerald-950 text-white text-[11px] sm:text-xs py-2 px-3 sm:px-4 border-b border-emerald-900/60">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5 sm:gap-2 text-center sm:text-left">
            <div class="flex items-center justify-center sm:justify-start gap-1.5 text-emerald-200">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                <span>Bantuan kecemasan emosi? Talian HEAL: <a href="tel:15555" class="underline font-bold hover:text-white">15555</a> (24 Jam) | Befrienders: <a href="tel:0376272929" class="underline font-bold hover:text-white">03-7627 2929</a></span>
            </div>
            <div class="flex items-center justify-center gap-3 text-emerald-300 text-[11px]">
                <a href="https://t.me/sakeenahcommunity" target="_blank" rel="noopener noreferrer" class="hover:text-white transition inline-flex items-center gap-1 font-medium">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.52 2.77-1.16 3.35-1.36 3.73-1.37.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .37z"/></svg>
                    Sakeenah Community
                </a>
                <span class="text-emerald-800">|</span>
                <span>Cyberjaya, Selangor</span>
            </div>
        </div>
    </aside>

    {{-- Main Navigation Bar --}}
    <header class="sticky top-0 z-50 bg-[#FBFBFB]/95 backdrop-blur-md border-b border-neutral-200/70 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">
            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <img src="{{ asset('media/logos/1.png') }}" alt="Sakeenah Medicare Logo" class="h-9 sm:h-11 w-auto object-contain transition-transform group-hover:scale-105 duration-200">
            </a>

            {{-- Desktop Navigation Links (Large Screens) --}}
            <nav class="hidden xl:flex items-center gap-6 2xl:gap-8 text-sm font-medium text-neutral-600 shrink-0">
                <a href="{{ route('home') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('home') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Laman Utama
                </a>
                <a href="{{ route('about') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('about') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('services.index') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('services.*') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Perkhidmatan
                </a>
                <a href="{{ route('practitioners.index') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('practitioners.*') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Pakar Kami
                </a>
                <a href="{{ route('articles.index') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('articles.*') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Artikel
                </a>
                <a href="{{ route('screener.index') }}" class="transition hover:text-[#2D6A4F] flex items-center gap-1.5 whitespace-nowrap {{ request()->routeIs('screener.*') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    <span class="inline-block w-2 h-2 rounded-full bg-amber-500"></span>
                    Ujian Saringan
                </a>
                <a href="{{ route('contact') }}" class="transition hover:text-[#2D6A4F] whitespace-nowrap {{ request()->routeIs('contact') ? 'text-[#2D6A4F] font-semibold' : '' }}">
                    Hubungi
                </a>
            </nav>

            {{-- Action Buttons --}}
            <div class="hidden sm:flex items-center gap-2.5 shrink-0">
                <a href="https://wa.me/601170352636?text=Salam%20Sakeenah%20Medicare,%20saya%20ingin%20bertanya%20mengenai%20sesi%20terapi" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="px-3.5 py-2 rounded-full text-xs font-semibold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/80 transition flex items-center gap-1.5 whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 fill-emerald-600 shrink-0" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                    <span>WhatsApp</span>
                </a>

                <a href="{{ route('booking.index') }}" 
                   class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-semibold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-1.5 sm:gap-2 whitespace-nowrap shrink-0">
                    <span>Tempah Sesi</span>
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            {{-- Mobile & Tablet Menu Toggle Button --}}
            <button type="button" 
                    id="mobile-menu-btn"
                    onclick="toggleMobileMenu()" 
                    aria-label="Toggle Navigation Menu"
                    class="xl:hidden p-2 rounded-xl text-neutral-700 hover:text-neutral-900 hover:bg-neutral-100 transition focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile & Tablet Dropdown Drawer --}}
        <div id="mobile-menu" class="hidden xl:hidden bg-white/98 border-b border-neutral-200 px-4 pt-3 pb-6 space-y-2 shadow-xl animate-in slide-in-from-top duration-200">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('home') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Laman Utama</a>
            <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('about') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Tentang Kami</a>
            <a href="{{ route('services.index') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('services.*') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Perkhidmatan</a>
            <a href="{{ route('practitioners.index') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('practitioners.*') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Pakar Kami</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('articles.*') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Artikel & Panduan</a>
            <a href="{{ route('screener.index') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('screener.*') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Ujian Saringan Minda (DASS-21)</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-neutral-700 hover:bg-emerald-50 hover:text-[#2D6A4F] {{ request()->routeIs('contact') ? 'bg-emerald-50 text-[#2D6A4F] font-semibold' : '' }}">Hubungi Kami</a>
            
            <div class="pt-3 border-t border-neutral-100 flex flex-col gap-2.5">
                <a href="{{ route('booking.index') }}" class="w-full text-center py-3 rounded-full font-bold text-sm text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow transition">
                    Tempah Sesi Sekarang
                </a>
                <a href="https://wa.me/601170352636?text=Salam%20Sakeenah%20Medicare,%20saya%20ingin%20bertanya%20mengenai%20sesi%20terapi" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-full text-center py-2.5 rounded-full font-semibold text-xs text-emerald-800 bg-emerald-50 border border-emerald-200">
                    Bantuan WhatsApp Terus
                </a>
            </div>
        </div>
    </header>

    {{-- Main Content Section --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer (Standard, Kemas & Padat) --}}
    <footer class="bg-neutral-900 text-neutral-300 pt-10 pb-8 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-neutral-800/80">
                
                {{-- Column 1: Info Sakeenah --}}
                <div class="space-y-3 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-2.5">
                        <img src="{{ asset('media/logos/1.png') }}" alt="Sakeenah Medicare Logo" class="h-8 w-auto brightness-0 invert">
                        <span class="text-lg font-bold tracking-tight text-white">SAKEENAH</span>
                    </div>
                    <p class="text-xs text-neutral-400 leading-relaxed">
                        Pusat Psikologi & Kesejahteraan Emosi di Cyberjaya. Ruang selamat, bertauliah dan tanpa prejudis untuk rawatan minda anda sekeluarga.
                    </p>
                    <div class="text-[11px] text-emerald-400 font-medium">
                        ✓ Berdaftar Lembaga Kaunselor Malaysia & MAHPC
                    </div>
                </div>

                {{-- Column 2: Perkhidmatan --}}
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-3">Perkhidmatan</h4>
                    <ul class="space-y-1.5 text-xs text-neutral-400">
                        <li><a href="{{ route('services.index') }}" class="hover:text-emerald-400 transition">Psikoterapi Individu</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-emerald-400 transition">Penilaian ADHD & Autisme</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-emerald-400 transition">Terapi Pasangan & Keluarga</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-emerald-400 transition">Terapi Pertuturan & Carakerja</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-emerald-400 transition">Program Korporat (EAP)</a></li>
                    </ul>
                </div>

                {{-- Column 3: Pautan Pantas --}}
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-3">Pautan Pantas</h4>
                    <ul class="space-y-1.5 text-xs text-neutral-400">
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition">Tentang Klinik</a></li>
                        <li><a href="{{ route('practitioners.index') }}" class="hover:text-emerald-400 transition">Direktori Pakar</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-emerald-400 transition">Hab Artikel</a></li>
                        <li><a href="{{ route('screener.index') }}" class="hover:text-emerald-400 transition">Ujian Saringan (DASS-21)</a></li>
                        <li><a href="{{ route('booking.index') }}" class="hover:text-emerald-400 transition">Tempah Sesi</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-neutral-500 hover:text-neutral-300 text-[11px]">Portal Kakitangan &rarr;</a></li>
                    </ul>
                </div>

                {{-- Column 4: Lokasi & Hubungi --}}
                <div class="sm:col-span-2 lg:col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-3">Klinik Kami</h4>
                    <div class="space-y-2 text-xs text-neutral-400">
                        <p class="leading-relaxed">
                            P3-03, Shaftsbury Square, Persiaran Multimedia, Cyber 6, 63000 Cyberjaya, Selangor
                        </p>
                        <p>
                            <a href="tel:+601170352636" class="hover:text-white transition">Tel: +60 11-7035 2636</a>
                        </p>
                        <p>
                            <a href="mailto:sakeenahmedicare@gmail.com" class="hover:text-white transition">sakeenahmedicare@gmail.com</a>
                        </p>
                        <p class="text-[11px] text-neutral-500 pt-1">
                            Isnin – Ahad (9:00 AM – 9:00 PM)
                        </p>
                    </div>
                </div>

            </div>

            {{-- Copyright & Privacy Statement --}}
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-neutral-500 gap-2 text-center sm:text-left">
                <p>&copy; {{ date('Y') }} Sakeenah Medicare (SKMED). Hak Cipta Terpelihara. Maklumat pesakit dilindungi di bawah PDPA.</p>
                <div class="flex items-center gap-4">
                    <a href="https://wa.me/601170352636" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition">WhatsApp Rasmi</a>
                    <a href="https://t.me/sakeenahcommunity" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition">Komuniti Telegram</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile Floating Quick Action (For mobile screen < 640px) --}}
    <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-neutral-200 px-4 py-2.5 flex items-center gap-2 shadow-[0_-4px_16px_rgba(0,0,0,0.06)]">
        <a href="https://wa.me/601170352636" 
           target="_blank"
           rel="noopener noreferrer"
           class="p-2.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0 flex items-center justify-center">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
        </a>
        <a href="{{ route('booking.index') }}" 
           class="flex-1 py-2.5 px-4 rounded-full bg-[#E07A5F] text-white text-xs font-bold text-center shadow-sm">
            Tempah Sesi Temu Janji
        </a>
    </div>

    {{-- Script for Toggle Menu --}}
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
            
            menu.classList.toggle('hidden');
            hamburger.classList.toggle('hidden');
            close.classList.toggle('hidden');
        }
    </script>
</body>
</html>
