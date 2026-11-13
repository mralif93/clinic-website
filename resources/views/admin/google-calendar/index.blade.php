@extends('layouts.admin')

@section('title', 'Penyelarasan Google Calendar | Sakeenah Medicare')
@section('page_title', 'Google Calendar')

@section('admin_content')
<div class="space-y-6">

    {{-- Breadcrumb & Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2 border-b border-neutral-200">
        <div>
            <nav class="flex items-center gap-2 text-xs text-neutral-400 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-700 transition">Portal Pentadbiran</a>
                <span>/</span>
                <span class="text-neutral-700 font-medium">Google Calendar</span>
            </nav>
            <h1 class="text-2xl font-bold text-neutral-900 tracking-tight flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-sm font-bold shadow-xs">
                    📅
                </span>
                Senarai Temujanji Google Calendar
            </h1>
            <p class="text-xs text-neutral-500 mt-0.5">
                Semua acara temujanji diselaraskan secara langsung dari Google Calendar klinik & pakar.
            </p>
        </div>

        {{-- Top Actions: Manual Sync Button & Auto-sync Status --}}
        <div class="flex flex-wrap items-center gap-2.5">
            <div class="hidden lg:flex items-center gap-1.5 px-3 py-2 rounded-xl bg-neutral-100 border border-neutral-200/80 text-[11px] text-neutral-600">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Auto-sync aktif: <strong>Setiap 1 jam</strong></span>
            </div>

            <form action="{{ route('admin.google-calendar.sync') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Segerak Sekarang (Sync Now)</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between gap-2 shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <span class="text-[10px] text-emerald-700 font-semibold uppercase">Berjaya</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-900 text-xs flex items-center justify-between gap-2 shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
            <span class="text-[10px] text-red-700 font-semibold uppercase">Perlu Perhatian</span>
        </div>
    @endif

    @if(! $hasIcalConfigured)
        <div class="p-4 rounded-2xl bg-amber-50/80 border border-amber-200 text-amber-900 text-xs space-y-2">
            <div class="flex items-center gap-2 font-bold">
                <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Konfigurasi Google Calendar Belum Ditetapkan:</span>
            </div>
            <p class="text-neutral-700 leading-relaxed text-[11px]">
                Untuk menyegerakkan temujanji, sila masukkan pautan <strong>Secret address in iCal format</strong> kalendar klinik anda ke dalam fail <code class="px-1.5 py-0.5 rounded bg-white border border-amber-200 text-neutral-800 font-mono">.env</code> pada baris:
            </p>
            <div class="p-2.5 rounded-lg bg-neutral-900 text-emerald-400 font-mono text-[11px] overflow-x-auto">
                GOOGLE_CALENDAR_ICAL_URL="https://calendar.google.com/calendar/ical/your-calendar-id/private-token/basic.ics"
            </div>
            <p class="text-[10px] text-neutral-500">
                Cara dapatkan: Buka Google Calendar &rarr; Tetapan (Settings) kalendar anda &rarr; Scroll ke bahagian "Integrate calendar" &rarr; Salin "Secret address in iCal format".
            </p>
        </div>
    @endif

    {{-- Stats Cards & Quick Metrics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
        <div class="p-4 rounded-2xl bg-white border border-neutral-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-neutral-500 uppercase tracking-wider">Akan Datang</p>
                <p class="text-2xl font-black text-[#2D6A4F] mt-1">{{ $totalUpcoming }}</p>
                <p class="text-[10px] text-neutral-400 mt-0.5">Sesi temujanji masa depan</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                ⏳
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white border border-neutral-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-neutral-500 uppercase tracking-wider">Hari Ini</p>
                <p class="text-2xl font-black text-amber-600 mt-1">{{ $totalToday }}</p>
                <p class="text-[10px] text-neutral-400 mt-0.5">Jadual temujanji tarikh ini</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                🎯
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white border border-neutral-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-neutral-500 uppercase tracking-wider">Semua Temujanji</p>
                <p class="text-2xl font-black text-neutral-800 mt-1">{{ $totalAll }}</p>
                <p class="text-[10px] text-neutral-400 mt-0.5">Disegerakkan dari G-Cal</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-neutral-100 text-neutral-700 flex items-center justify-center font-bold">
                📋
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-white border border-neutral-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-neutral-500 uppercase tracking-wider">Status Sync</p>
                <p class="text-xs font-bold text-neutral-800 mt-2">
                    {{ $lastSyncedAt ? $lastSyncedAt->timezone(config('app.timezone'))->format('d/m/Y, h:i A') : 'Belum sync' }}
                </p>
                <p class="text-[10px] text-neutral-400 mt-0.5">
                    {{ $lastSyncedAt ? $lastSyncedAt->diffForHumans() : 'Sila klik Sync' }}
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                🔄
            </div>
        </div>
    </div>

    {{-- Quick Status Filter Tabs --}}
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <a href="{{ route('admin.google-calendar.index', array_filter(['search' => $search, 'date' => $date, 'start_date' => $startDate, 'end_date' => $endDate])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ empty($timeframe) || $timeframe === 'all' ? 'bg-[#2D6A4F] text-white shadow-xs' : 'bg-white border border-neutral-200 text-neutral-600 hover:bg-neutral-50' }}">
            <span>Semua Rekod</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ empty($timeframe) || $timeframe === 'all' ? 'bg-white/20 text-white' : 'bg-neutral-100 text-neutral-700' }}">{{ $totalAll }}</span>
        </a>

        <a href="{{ route('admin.google-calendar.index', array_filter(['timeframe' => 'upcoming', 'search' => $search])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $timeframe === 'upcoming' ? 'bg-[#2D6A4F] text-white shadow-xs' : 'bg-white border border-neutral-200 text-emerald-800 hover:bg-emerald-50/50' }}">
            <span>Akan Datang</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $timeframe === 'upcoming' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $totalUpcoming }}</span>
        </a>

        <a href="{{ route('admin.google-calendar.index', array_filter(['timeframe' => 'today', 'search' => $search])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $timeframe === 'today' ? 'bg-amber-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-amber-700 hover:bg-amber-50/50' }}">
            <span>Hari Ini</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $timeframe === 'today' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $totalToday }}</span>
        </a>

        <a href="{{ route('admin.google-calendar.index', array_filter(['timeframe' => 'past', 'search' => $search])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $timeframe === 'past' ? 'bg-neutral-700 text-white shadow-xs' : 'bg-white border border-neutral-200 text-neutral-600 hover:bg-neutral-50' }}">
            <span>Terdahulu</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $timeframe === 'past' ? 'bg-white/20 text-white' : 'bg-neutral-100 text-neutral-700' }}">{{ $totalPast }}</span>
        </a>
    </div>

    {{-- Search & Filter Card (Standardized Design) --}}
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200/90 shadow-2xs space-y-3" 
         x-data="{ 
             dateFilterMode: '{{ ($startDate || $endDate) ? 'range' : ($date ? 'single' : 'timeframe') }}' 
         }">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-neutral-100 pb-2.5">
            <div class="flex items-center gap-2 text-neutral-800">
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Carian & Tapisan Temujanji Google Calendar</h3>
            </div>
            
            {{-- Switcher: Jangka Masa / Tarikh Khusus / Julat Tarikh --}}
            <div class="flex items-center bg-neutral-100 p-0.5 rounded-xl text-[11px] font-medium text-neutral-600 self-start sm:self-auto">
                <button type="button" 
                        @click="dateFilterMode = 'timeframe'" 
                        :class="dateFilterMode === 'timeframe' ? 'bg-white text-emerald-800 font-bold shadow-2xs' : 'text-neutral-500 hover:text-neutral-900'"
                        class="px-2.5 py-1 rounded-lg transition cursor-pointer">
                    Jangka Masa
                </button>
                <button type="button" 
                        @click="dateFilterMode = 'single'" 
                        :class="dateFilterMode === 'single' ? 'bg-white text-emerald-800 font-bold shadow-2xs' : 'text-neutral-500 hover:text-neutral-900'"
                        class="px-2.5 py-1 rounded-lg transition cursor-pointer">
                    Satu Tarikh
                </button>
                <button type="button" 
                        @click="dateFilterMode = 'range'" 
                        :class="dateFilterMode === 'range' ? 'bg-white text-emerald-800 font-bold shadow-2xs' : 'text-neutral-500 hover:text-neutral-900'"
                        class="px-2.5 py-1 rounded-lg transition cursor-pointer">
                    Julat Tarikh (Range)
                </button>
            </div>
        </div>

        <form action="{{ route('admin.google-calendar.index') }}" method="GET" class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3 pt-0.5">
            {{-- Keyword Search --}}
            <div class="grow relative">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari nama pesakit, tajuk sesi, deskripsi, lokasi atau emel..." 
                       class="w-full h-10 pl-9 pr-3.5 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition placeholder:text-neutral-400">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            {{-- 1. Mode Jangka Masa (Quick Timeframe) --}}
            <div x-show="dateFilterMode === 'timeframe'" class="w-full lg:w-48 relative shrink-0">
                <select name="timeframe" 
                        class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="all" {{ empty($timeframe) || $timeframe === 'all' ? 'selected' : '' }}>Semua Masa</option>
                    <option value="upcoming" {{ $timeframe === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="today" {{ $timeframe === 'today' ? 'selected' : '' }}>Hari Ini Sahaja</option>
                    <option value="past" {{ $timeframe === 'past' ? 'selected' : '' }}>Terdahulu (Lepas)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- 2. Mode Satu Tarikh (Single Date) --}}
            <div x-show="dateFilterMode === 'single'" style="display: none;" class="w-full lg:w-48 relative shrink-0">
                <input type="date" 
                       name="date" 
                       value="{{ $date }}" 
                       class="w-full h-10 px-3 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
            </div>

            {{-- 3. Mode Julat Tarikh (Date Range) --}}
            <div x-show="dateFilterMode === 'range'" style="display: none;" class="flex items-center gap-2 shrink-0">
                <div class="relative">
                    <input type="date" 
                           name="start_date" 
                           value="{{ $startDate }}" 
                           title="Tarikh Mula"
                           placeholder="Mula"
                           class="w-36 h-10 px-3 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                </div>
                <span class="text-xs text-neutral-400 font-bold">hingga</span>
                <div class="relative">
                    <input type="date" 
                           name="end_date" 
                           value="{{ $endDate }}" 
                           title="Tarikh Tamat"
                           placeholder="Tamat"
                           class="w-36 h-10 px-3 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                </div>
            </div>

            {{-- Submit & Reset Buttons --}}
            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" 
                        class="h-10 px-5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-xs font-bold text-white shadow-2xs transition flex items-center justify-center gap-1.5 grow lg:grow-0 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Tapis</span>
                </button>
                @if($search || ($timeframe && $timeframe !== 'all') || $date || $startDate || $endDate)
                    <a href="{{ route('admin.google-calendar.index') }}" 
                       class="h-10 px-3.5 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Appointments Table List --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-neutral-50/80 border-b border-neutral-200 text-[10px] font-bold text-neutral-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4 min-w-[130px]">Tarikh & Waktu</th>
                        <th class="py-3.5 px-4 min-w-[220px]">Maklumat Sesi & Klien</th>
                        <th class="py-3.5 px-4 min-w-[140px]">Mod & Lokasi</th>
                        <th class="py-3.5 px-4 min-w-[180px]">Catatan / Deskripsi</th>
                        <th class="py-3.5 px-4 min-w-[130px]">Peserta</th>
                        <th class="py-3.5 px-4 text-center min-w-[90px]">Status</th>
                        <th class="py-3.5 px-4 text-right min-w-[100px]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($events as $event)
                        @php
                            $summary = $event->summary;
                            $desc = $event->description ?? '';
                            $loc = $event->location ?? '';

                            // Extract Meet URL and Clean Notes using GoogleCalendarHelper
                            $meetUrl = \App\Helpers\GoogleCalendarHelper::extractMeetUrl($loc, $desc);
                            $cleanDesc = \App\Helpers\GoogleCalendarHelper::cleanDescription($desc);

                            // Detect Mode (online vs physical)
                            $isOnline = $meetUrl || str_contains(strtolower($summary), 'online') || str_contains(strtolower($loc), 'online') || str_contains(strtolower($desc), 'online');
                            $isPhysical = str_contains(strtolower($summary), 'physical') || str_contains(strtolower($loc), 'physical') || str_contains(strtolower($desc), 'physical');

                            // Extract Practitioner and Client from summary pattern e.g. "CL Sha'ari x Pn Fatihah (physical)"
                            $parts = preg_split('/\s+x\s+/i', $summary);
                            $practitionerName = null;
                            $clientPart = $summary;

                            if (count($parts) >= 2) {
                                $practitionerName = trim($parts[0]);
                                $clientPart = trim($parts[1]);
                            }

                            // Extract Session number e.g. "4/4" or "1/4"
                            $sessionNo = null;
                            if (preg_match('/(\d+\/\d+)/', $summary, $sessMatches)) {
                                $sessionNo = $sessMatches[1];
                            }
                        @endphp
                        <tr class="hover:bg-neutral-50/70 transition">
                            {{-- 1. Date & Time (Mini Calendar Widget) --}}
                            <td class="py-3.5 px-4 align-top whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-11 h-12 rounded-xl bg-neutral-100 border border-neutral-200/90 flex flex-col items-center justify-center shrink-0 shadow-2xs">
                                        <span class="text-[9px] font-black uppercase tracking-wider text-emerald-800 leading-none">
                                            {{ strtoupper($event->start_time->translatedFormat('M')) }}
                                        </span>
                                        <span class="text-base font-black text-neutral-900 leading-tight">
                                            {{ $event->start_time->format('d') }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-neutral-800 text-xs">
                                            @if($event->is_all_day)
                                                <span class="px-1.5 py-0.5 rounded bg-neutral-200 text-neutral-700 text-[10px] font-bold">Sepanjang Hari</span>
                                            @else
                                                {{ $event->start_time->format('h:i A') }}
                                            @endif
                                        </div>
                                        <div class="text-[10px] text-neutral-400 font-medium">
                                            {{ $event->start_time->translatedFormat('l') }}
                                            @if(! $event->is_all_day && $event->end_time)
                                                <span class="text-neutral-500">· {{ $event->start_time->diffInMinutes($event->end_time) }}m</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- 2. Session & Client Info --}}
                            <td class="py-3.5 px-4 align-top">
                                <div class="space-y-1">
                                    <div class="font-bold text-neutral-900 text-xs flex flex-wrap items-center gap-1.5">
                                        <span>{{ $clientPart }}</span>
                                        @if($sessionNo)
                                            <span class="px-1.5 py-0.2 rounded-md bg-neutral-100 border border-neutral-200 text-neutral-600 text-[10px] font-bold">
                                                Sesi {{ $sessionNo }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($practitionerName)
                                        <div class="flex items-center gap-1 text-[11px] text-[#2D6A4F] font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#2D6A4F]"></span>
                                            <span>Pakar: {{ $practitionerName }}</span>
                                        </div>
                                    @endif

                                    @if($event->organizer_email)
                                        <div class="text-[10px] text-neutral-400 flex items-center gap-1 truncate max-w-[200px]" title="{{ $event->organizer_email }}">
                                            <svg class="w-3 h-3 text-neutral-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                            <span class="truncate">{{ $event->organizer_email }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- 3. Mode & Location --}}
                            <td class="py-3.5 px-4 align-top">
                                <div class="space-y-1.5">
                                    {{-- Mode Badge --}}
                                    @if($isOnline)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-blue-50 text-blue-700 border border-blue-200/80 text-[10px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            <span>Online (Maya)</span>
                                        </span>
                                    @elseif($isPhysical)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200/80 text-[10px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                            <span>Fizikal (Klinik)</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-neutral-100 text-neutral-600 text-[10px] font-semibold">
                                            <span>Klinik</span>
                                        </span>
                                    @endif

                                    {{-- Meet URL Button if available --}}
                                    @if($meetUrl)
                                        <div>
                                            <a href="{{ $meetUrl }}" target="_blank" rel="noopener noreferrer" 
                                               class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-bold transition shadow-2xs">
                                                <span>Google Meet</span>
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        </div>
                                    @elseif($loc && ! str_contains(strtolower($loc), 'tiada'))
                                        <div class="text-[11px] text-neutral-600 truncate max-w-[140px]" title="{{ $loc }}">
                                            📍 {{ $loc }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- 4. Description / Clinical Notes --}}
                            <td class="py-3.5 px-4 align-top max-w-xs">
                                @if(!empty($cleanDesc))
                                    <p class="text-neutral-600 line-clamp-2 text-[11px] leading-relaxed" title="{{ $cleanDesc }}">
                                        {{ $cleanDesc }}
                                    </p>
                                @else
                                    <span class="text-neutral-300 italic text-[11px]">- Tiada nota -</span>
                                @endif
                            </td>

                            {{-- 5. Attendees (Stacked Avatars) --}}
                            <td class="py-3.5 px-4 align-top">
                                @if(!empty($event->attendees) && count($event->attendees) > 0)
                                    <div class="space-y-1">
                                        <div class="flex items-center -space-x-1.5 overflow-hidden">
                                            @foreach(array_slice($event->attendees, 0, 3) as $att)
                                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#2D6A4F] text-white text-[10px] font-bold border-2 border-white shadow-2xs" 
                                                     title="{{ $att }}">
                                                    {{ strtoupper(substr($att, 0, 1)) }}
                                                </div>
                                            @endforeach
                                            @if(count($event->attendees) > 3)
                                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-neutral-200 text-neutral-700 text-[9px] font-bold border-2 border-white">
                                                    +{{ count($event->attendees) - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-[10px] text-neutral-500 font-medium">
                                            {{ count($event->attendees) }} peserta
                                        </div>
                                    </div>
                                @else
                                    <span class="text-neutral-300 italic text-[11px]">-</span>
                                @endif
                            </td>

                            {{-- 6. Status Badge --}}
                            <td class="py-3.5 px-4 align-top text-center whitespace-nowrap">
                                @if(strtolower($event->status) === 'cancelled')
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                        Batal
                                    </span>
                                @elseif($event->start_time->isPast())
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-200">
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Aktif / Sah
                                    </span>
                                @endif
                            </td>

                            {{-- 7. Actions --}}
                            <td class="py-3.5 px-4 align-top text-right whitespace-nowrap">
                                <a href="{{ route('admin.google-calendar.show', $event->id) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-900 text-neutral-700 hover:text-white text-xs font-bold transition shadow-2xs group">
                                    <span>Perincian</span>
                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-neutral-500">
                                <div class="max-w-sm mx-auto space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-neutral-100 text-neutral-400 flex items-center justify-center mx-auto text-xl">
                                        📅
                                    </div>
                                    <p class="font-bold text-neutral-700 text-sm">Tiada temujanji Google Calendar ditemui</p>
                                    <p class="text-xs text-neutral-400">
                                        Klik butang <strong>"Segerak Sekarang (Sync Now)"</strong> di atas untuk memuat turun semua temujanji terkini dari Google Calendar anda.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($events->hasPages())
            <div class="p-4 border-t border-neutral-200">
                {{ $events->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
