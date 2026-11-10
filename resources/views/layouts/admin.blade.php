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
<body class="bg-neutral-100 text-neutral-800 font-sans antialiased flex min-h-screen">

    {{-- Admin Sidebar Navigation --}}
    <aside class="w-64 bg-neutral-900 text-neutral-300 flex flex-col shrink-0 border-r border-neutral-800 hidden md:flex">
        {{-- Brand --}}
        <div class="h-18 px-6 flex items-center gap-3 border-b border-neutral-800">
            <img src="{{ asset('media/logos/1.png') }}" alt="Sakeenah Logo" class="h-9 w-auto brightness-0 invert">
            <div>
                <span class="font-bold text-white tracking-tight block leading-none">SAKEENAH</span>
                <span class="text-[10px] text-emerald-400 font-semibold uppercase tracking-widest">Portal Admin</span>
            </div>
        </div>

        {{-- Nav Links --}}
        <nav class="p-4 space-y-1.5 flex-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#2D6A4F] text-white' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Papan Pemuka
            </a>

            <a href="{{ route('admin.appointments.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.appointments.*') ? 'bg-[#2D6A4F] text-white' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Senarai Tempahan
            </a>

            <a href="{{ route('admin.screeners.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold {{ request()->routeIs('admin.screeners.*') ? 'bg-[#2D6A4F] text-white' : 'hover:bg-neutral-800 text-neutral-400 hover:text-white' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Respons DASS-21
            </a>
        </nav>

        {{-- Bottom Public Link --}}
        <div class="p-4 border-t border-neutral-800">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-neutral-400 hover:text-white hover:bg-neutral-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Buka Laman Awam
            </a>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col min-w-0">
        {{-- Topbar --}}
        <header class="h-18 bg-white border-b border-neutral-200 px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-neutral-900">@yield('page_title', 'Papan Pemuka')</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Staf Klinik Aktif
                </span>
            </div>
        </header>

        {{-- Content --}}
        <main class="p-6 sm:p-8 flex-1 overflow-y-auto">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-xs">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>

</body>
</html>

