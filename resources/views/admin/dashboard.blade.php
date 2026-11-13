@extends('layouts.admin')

@section('title', 'Papan Pemuka Pentadbiran | Sakeenah Medicare')
@section('page_title', 'Papan Pemuka Pentadbiran Klinik')

@section('admin_content')
<div class="space-y-7">

    {{-- Welcome Hero Banner --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#1E4634] via-[#2D6A4F] to-[#3B7A5E] text-white p-6 sm:p-8 shadow-sm">
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute right-1/3 -top-12 w-48 h-48 bg-emerald-300/10 rounded-full blur-xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1.5 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs text-[11px] font-bold text-emerald-200 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pusat Kesejahteraan Mental Sakeenah</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-white">
                    Selamat Kembali, {{ auth()->user()->name ?? 'Pentadbir' }}
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Ringkasan aktiviti temu janji terapi, kehadiran pesakit, dan saringan kesihatan minda DASS-21 klinik untuk hari ini.
                </p>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                    <span>{{ $pendingAppointments }} Menunggu Tindakan</span>
                </a>
                <a href="{{ route('booking.index') }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white text-xs font-bold backdrop-blur-xs transition flex items-center gap-1.5 border border-white/20">
                    <span>Borang Awam</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- 4 Stat Metric Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        {{-- Total Appointments --}}
        <div class="p-5 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Jumlah Tempahan</span>
                <div class="w-10 h-10 rounded-xl bg-neutral-100 text-neutral-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <div class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">{{ $totalAppointments }}</div>
                <span class="text-[11px] font-bold text-neutral-500">Semua Rekod</span>
            </div>
            <div class="mt-3 pt-3 border-t border-neutral-100 flex items-center justify-between text-[11px] text-neutral-400">
                <span>Hari Ini: <strong class="text-neutral-800">{{ $todayAppointments }} Sesi</strong></span>
                <a href="{{ route('admin.appointments.index') }}" class="text-[#2D6A4F] font-bold hover:underline">Semua &rarr;</a>
            </div>
        </div>

        {{-- Pending Confirmation --}}
        <div class="p-5 rounded-2xl bg-white border border-amber-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700">Perlu Tindakan</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-600 tracking-tight">{{ $pendingAppointments }}</div>
                <span class="text-[11px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">Menunggu</span>
            </div>
            <div class="mt-3 pt-3 border-t border-neutral-100 flex items-center justify-between text-[11px]">
                <span class="text-neutral-500">Deposit & Jadual Belum Sah</span>
                <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="text-amber-700 font-bold hover:underline">Semak &rarr;</a>
            </div>
        </div>

        {{-- Confirmed Slots --}}
        <div class="p-5 rounded-2xl bg-white border border-emerald-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">Slot Disahkan</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700 tracking-tight">{{ $confirmedAppointments }}</div>
                <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Terkunci</span>
            </div>
            <div class="mt-3 pt-3 border-t border-neutral-100 flex items-center justify-between text-[11px]">
                <span class="text-neutral-500">Deposit Dibayar: <strong class="text-emerald-700">RM {{ number_format($totalDepositCollected, 2) }}</strong></span>
                <a href="{{ route('admin.appointments.index', ['status' => 'confirmed']) }}" class="text-emerald-700 font-bold hover:underline">Lihat &rarr;</a>
            </div>
        </div>

        {{-- DASS-21 Screeners --}}
        <div class="p-5 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-sky-700">Saringan DASS-21</span>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 border border-sky-100 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline justify-between">
                <div class="text-2xl sm:text-3xl font-extrabold text-sky-700 tracking-tight">{{ $totalScreeners }}</div>
                <span class="text-[11px] font-bold text-sky-700 bg-sky-50 px-2 py-0.5 rounded-full">Responden</span>
            </div>
            <div class="mt-3 pt-3 border-t border-neutral-100 flex items-center justify-between text-[11px]">
                <span class="text-neutral-500">Ujian Minda Kendiri</span>
                <a href="{{ route('admin.screeners.index') }}" class="text-sky-700 font-bold hover:underline">Log &rarr;</a>
            </div>
        </div>

    </div>

    {{-- Main 2-Column Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        {{-- Left Section: Recent Appointments (8 Cols) --}}
        <div class="lg:col-span-8 bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-neutral-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#2D6A4F] flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-neutral-900 tracking-tight">Tempahan Sesi Terkini</h3>
                        <p class="text-xs text-neutral-400">Senarai klien yang baru menempah slot sesi terapi klinik.</p>
                    </div>
                </div>

                <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-neutral-200 text-xs font-bold text-neutral-700 hover:bg-neutral-50 transition self-start sm:self-auto">
                    <span>Lihat Semua ({{ $totalAppointments }})</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-neutral-600">
                    <thead class="bg-neutral-50/80 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                        <tr>
                            <th class="py-3.5 px-4 min-w-[110px]">Kod</th>
                            <th class="py-3.5 px-4 min-w-[160px]">Klien</th>
                            <th class="py-3.5 px-4 min-w-[160px]">Rawatan & Mod</th>
                            <th class="py-3.5 px-4 min-w-[130px]">Tarikh & Masa</th>
                            <th class="py-3.5 px-4 min-w-[100px]">Status</th>
                            <th class="py-3.5 px-4 text-right min-w-[110px]">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @forelse($recentAppointments as $app)
                            <tr class="hover:bg-neutral-50/70 transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-neutral-900">
                                    <a href="{{ route('admin.appointments.show', $app->id) }}" class="text-[#2D6A4F] hover:underline">
                                        {{ $app->booking_code }}
                                    </a>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-neutral-900 block">{{ $app->client_name }}</span>
                                    <span class="text-[11px] text-neutral-400 block">{{ $app->client_phone }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-medium text-neutral-900 block truncate max-w-[160px]">{{ $app->service->name }}</span>
                                    <span class="text-[10px] text-neutral-400">
                                        {{ $app->session_mode === 'in_person' ? '● Fizikal (Cyberjaya)' : '○ Dalam Talian' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-neutral-800 block">{{ $app->appointment_date->format('d/m/Y') }}</span>
                                    <span class="text-[11px] text-neutral-500">{{ $app->appointment_time }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @php
                                        $badgeStyles = [
                                            'pending' => 'bg-amber-50 text-amber-800 border-amber-200/80',
                                            'confirmed' => 'bg-emerald-50 text-emerald-800 border-emerald-200/80',
                                            'completed' => 'bg-blue-50 text-blue-800 border-blue-200/80',
                                            'cancelled' => 'bg-rose-50 text-rose-800 border-rose-200/80',
                                        ];
                                        $badgeLabels = [
                                            'pending' => 'Pending',
                                            'confirmed' => 'Sah',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Batal',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeStyles[$app->status] ?? 'bg-neutral-100 text-neutral-700' }}">
                                        {{ $badgeLabels[$app->status] ?? ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $app->client_phone);
                                            if (str_starts_with($cleanPhone, '0')) {
                                                $cleanPhone = '60' . substr($cleanPhone, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanPhone }}?text=Salam%20{{ urlencode($app->client_name) }},%20kami%20dari%20Sakeenah%20Medicare%20mengenai%20tempahan%20sesi%20anda%20({{ $app->booking_code }})." 
                                           target="_blank" 
                                           rel="noopener noreferrer" 
                                           class="p-1.5 rounded-lg text-emerald-700 hover:bg-emerald-50 transition" 
                                           title="WhatsApp Klien">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.appointments.show', $app->id) }}" 
                                           class="px-2.5 py-1 rounded-lg text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-2xs transition">
                                            Urus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-neutral-400">
                                    <p class="text-xs">Tiada rekod tempahan dijumpai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Right Section: Quick Shortcuts, Directory & DASS-21 (4 Cols) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Quick Action Cards --}}
            <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Pintasan Pengurusan</h4>
                    <span class="text-[10px] text-neutral-400">Akses Pantas</span>
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="{{ route('admin.services.create') }}" class="p-3 rounded-xl border border-neutral-200/90 hover:border-emerald-300 hover:bg-emerald-50/40 transition group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-800">+ Servis</span>
                        <span class="text-[10px] text-neutral-400 block mt-0.5">{{ $totalServices }} pakej rawatan</span>
                    </a>
                    <a href="{{ route('admin.practitioners.create') }}" class="p-3 rounded-xl border border-neutral-200/90 hover:border-emerald-300 hover:bg-emerald-50/40 transition group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-800">+ Pakar</span>
                        <span class="text-[10px] text-neutral-400 block mt-0.5">{{ $totalPractitioners }} pengamal</span>
                    </a>
                    <a href="{{ route('admin.articles.create') }}" class="p-3 rounded-xl border border-neutral-200/90 hover:border-emerald-300 hover:bg-emerald-50/40 transition group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-800">+ Tulis Blog</span>
                        <span class="text-[10px] text-neutral-400 block mt-0.5">{{ $totalArticles }} artikel</span>
                    </a>
                    <a href="{{ route('admin.appointments.index') }}" class="p-3 rounded-xl border border-neutral-200/90 hover:border-emerald-300 hover:bg-emerald-50/40 transition group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-800">Kalendar</span>
                        <span class="text-[10px] text-neutral-400 block mt-0.5">Semak jadual</span>
                    </a>
                </div>
            </div>

            {{-- Recent DASS-21 Submissions --}}
            <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Hasil Saringan DASS-21</h4>
                        <p class="text-[10px] text-neutral-400">Responden ujian minda terkini</p>
                    </div>
                    <a href="{{ route('admin.screeners.index') }}" class="text-[11px] font-bold text-[#2D6A4F] hover:underline">Semua &rarr;</a>
                </div>

                <div class="space-y-2.5">
                    @forelse($recentScreeners as $sc)
                        <a href="{{ route('admin.screeners.show', $sc->id) }}" class="block p-3 rounded-xl bg-neutral-50/80 hover:bg-neutral-100 transition border border-neutral-200/70">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="font-bold text-neutral-900 text-xs">{{ $sc->client_name ?: 'Pelawat Tanpa Nama' }}</span>
                                <span class="text-[10px] text-neutral-400">{{ $sc->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-[10px]">
                                <span class="px-2 py-0.5 rounded-md font-bold {{ in_array($sc->depression_severity, ['Severe', 'Extremely Severe']) ? 'bg-rose-100 text-rose-800' : 'bg-neutral-100 text-neutral-700' }}">
                                    D: {{ $sc->depression_severity }}
                                </span>
                                <span class="px-2 py-0.5 rounded-md font-bold {{ in_array($sc->anxiety_severity, ['Severe', 'Extremely Severe']) ? 'bg-amber-100 text-amber-800' : 'bg-neutral-100 text-neutral-700' }}">
                                    A: {{ $sc->anxiety_severity }}
                                </span>
                                <span class="px-2 py-0.5 rounded-md font-bold {{ in_array($sc->stress_severity, ['Severe', 'Extremely Severe']) ? 'bg-blue-100 text-blue-800' : 'bg-neutral-100 text-neutral-700' }}">
                                    S: {{ $sc->stress_severity }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-neutral-400 text-center py-4">Tiada rekod saringan terkini.</p>
                    @endforelse
                </div>
            </div>

            {{-- Practitioners Overview Card --}}
            <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Pasukan Pakar Aktif</h4>
                        <p class="text-[10px] text-neutral-400">{{ $totalPractitioners }} pakar berdaftar</p>
                    </div>
                    <a href="{{ route('admin.practitioners.index') }}" class="text-[11px] font-bold text-[#2D6A4F] hover:underline">Urus &rarr;</a>
                </div>

                <div class="space-y-2">
                    @foreach($practitioners as $p)
                        <div class="flex items-center justify-between p-2 rounded-xl hover:bg-neutral-50 transition">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="w-8 h-8 rounded-full bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200">
                                    <img src="{{ asset($p->photo_path ?: 'media/team/CL Adeera.png') }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <span class="font-bold text-neutral-900 text-xs block truncate">{{ $p->name }}</span>
                                    <span class="text-[10px] text-neutral-400 block truncate">{{ $p->title }}</span>
                                </div>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0 ml-2" title="Aktif Bertugas"></span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
