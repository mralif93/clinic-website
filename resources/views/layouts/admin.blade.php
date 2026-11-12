<!DOCTYPE html>
<html lang="ms" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', 'Portal Pentadbiran | Sakeenah Medicare')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-100 text-neutral-800 font-sans antialiased flex min-h-screen" x-data="{ mobileMenuOpen: false }">

    {{-- Mobile Overlay Backdrop --}}
    <div id="admin-mobile-backdrop" 
         class="fixed inset-0 z-40 bg-black/60 backdrop-blur-xs md:hidden hidden transition-opacity"
         onclick="toggleAdminSidebar()"></div>

    {{-- Admin Sidebar Navigation --}}
    <aside id="admin-sidebar" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-neutral-900 text-neutral-300 flex flex-col shrink-0 border-r border-neutral-800 -translate-x-full md:translate-x-0 md:static md:z-auto transition-transform duration-300 ease-in-out">
        
        {{-- Brand --}}
        <div class="h-16 px-5 flex items-center justify-between border-b border-neutral-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-white/10 p-1 flex items-center justify-center border border-white/10 overflow-hidden shrink-0">
                    <img src="{{ asset('media/logos/cropped-8c3e544b-6b9a-42f8-bf7d-7a5d1e4e9cfd.png') }}" alt="Sakeenah Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-extrabold text-white tracking-tight block leading-none text-sm">SAKEENAH</span>
                    <span class="text-[9px] text-emerald-400 font-bold uppercase tracking-widest block mt-0.5">Portal Admin</span>
                </div>
            </a>
            {{-- Mobile Close Button --}}
            <button type="button" 
                    onclick="toggleAdminSidebar()" 
                    class="md:hidden p-1.5 rounded-lg text-neutral-400 hover:text-white hover:bg-neutral-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Nav Links --}}
        <nav class="p-3.5 space-y-1 flex-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Papan Pemuka</span>
            </a>

            <a href="{{ route('admin.appointments.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.appointments.*') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Senarai Tempahan</span>
                </div>
                @php
                    $pendingCount = \App\Models\Appointment::where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.services.*') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                <span>Perkhidmatan</span>
            </a>

            <a href="{{ route('admin.practitioners.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.practitioners.*') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Pakar & Terapis</span>
            </a>

            <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.articles.*') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>Artikel & Blog</span>
            </a>

            <a href="{{ route('admin.screeners.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.screeners.*') ? 'bg-[#2D6A4F] text-white shadow-xs' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                <span>Respons DASS-21</span>
            </a>
        </nav>

        {{-- Bottom Public Link & Logout --}}
        <div class="p-3.5 border-t border-neutral-800 space-y-1.5">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-neutral-400 hover:text-white hover:bg-neutral-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Laman Awam</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-rose-400 hover:text-rose-200 hover:bg-rose-950/40 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Log Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col min-w-0">
        {{-- Topbar --}}
        <header class="h-16 bg-white border-b border-neutral-200/90 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                {{-- Mobile Hamburger Toggle --}}
                <button type="button" 
                        onclick="toggleAdminSidebar()" 
                        class="md:hidden p-2 rounded-xl text-neutral-600 hover:bg-neutral-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <div>
                    <h1 class="text-sm sm:text-base font-bold text-neutral-900 leading-tight">@yield('page_title', 'Papan Pemuka')</h1>
                    <span class="text-[11px] text-neutral-400 hidden sm:block">Sistem Pengurusan Klinik Sakeenah Medicare</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-xs font-bold text-neutral-800 leading-tight">{{ auth()->user()->name ?? 'Pentadbir' }}</span>
                    <span class="text-[10px] text-emerald-600 font-semibold tracking-wide">Staf Bertauliah</span>
                </div>
                <div class="w-9 h-9 rounded-xl bg-[#2D6A4F] text-white font-bold text-xs flex items-center justify-center shadow-xs">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Content Container --}}
        <main class="flex-1 overflow-y-auto bg-neutral-50/50">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2.5 shadow-2xs">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2.5 shadow-2xs">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('admin_content')
            </div>
        </main>
    </div>

    {{-- Script for Toggle Mobile Admin Sidebar --}}
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-mobile-backdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
