@extends('layouts.admin')

@section('title', 'Papan Pemuka Pentadbiran | Sakeenah Medicare')
@section('page_title', 'Papan Pemuka Pentadbiran Klinik')

@section('admin_content')
<div class="space-y-8">
    
    {{-- Metric Stat Cards with Elegant Icons --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        {{-- Card 1: Total Appointments --}}
        <div class="p-5 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs hover:shadow-xs transition flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-neutral-400 block mb-1">Jumlah Tempahan</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-neutral-900">{{ $totalAppointments }}</div>
                <span class="text-[11px] text-neutral-500 mt-1 block">Semua sesi direkodkan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-neutral-100 text-neutral-700 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        {{-- Card 2: Pending Confirmation --}}
        <div class="p-5 rounded-2xl bg-white border border-amber-200/60 shadow-2xs hover:shadow-xs transition flex items-center justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full blur-xl pointer-events-none"></div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700 block mb-1">Perlu Tindakan</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-600">{{ $pendingAppointments }}</div>
                <span class="text-[11px] text-amber-800/80 mt-1 block font-medium">Menunggu pengesahan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        {{-- Card 3: Confirmed Slots --}}
        <div class="p-5 rounded-2xl bg-white border border-emerald-200/60 shadow-2xs hover:shadow-xs transition flex items-center justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full blur-xl pointer-events-none"></div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Slot Disahkan</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700">{{ $confirmedAppointments }}</div>
                <span class="text-[11px] text-emerald-800/80 mt-1 block font-medium">Deposit / Jadual dikunci</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        {{-- Card 4: DASS-21 Responses --}}
        <div class="p-5 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs hover:shadow-xs transition flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#2A6F97] block mb-1">Saringan DASS-21</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-[#2A6F97]">{{ $totalScreeners }}</div>
                <span class="text-[11px] text-neutral-500 mt-1 block">Ujian kendiri selesai</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#2A6F97] border border-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
        </div>

    </div>

    {{-- Main Grid: Recent Appointments & Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Recent Appointments Table (8 cols) --}}
        <div class="lg:col-span-8 bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-neutral-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-neutral-900 tracking-tight">Tempahan Sesi Terkini</h3>
                    <p class="text-xs text-neutral-500">Senarai pesakit yang baru menempah slot temu janji terapi.</p>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#2D6A4F] hover:underline">
                    <span>Lihat Semua</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-neutral-600">
                    <thead class="bg-neutral-50/80 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-y border-neutral-200/80">
                        <tr>
                            <th class="py-3 px-3">Kod</th>
                            <th class="py-3 px-3">Klien</th>
                            <th class="py-3 px-3">Perkhidmatan</th>
                            <th class="py-3 px-3">Tarikh</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @forelse($recentAppointments as $app)
                            <tr class="hover:bg-neutral-50/60 transition">
                                <td class="py-3 px-3 font-mono font-bold text-neutral-900 text-[11px]">{{ $app->booking_code }}</td>
                                <td class="py-3 px-3">
                                    <span class="font-bold text-neutral-900 block">{{ $app->client_name }}</span>
                                    <span class="text-[11px] text-neutral-400">{{ $app->client_phone }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    <span class="font-medium text-neutral-800 block truncate max-w-[150px]">{{ $app->service->name }}</span>
                                    <span class="text-[10px] text-neutral-400 capitalize">{{ $app->session_mode }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    <span class="font-semibold text-neutral-900 block">{{ $app->appointment_date->format('d/m/Y') }}</span>
                                    <span class="text-[11px] text-neutral-400">{{ $app->appointment_time }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    @php
                                        $badge = match($app->status) {
                                            'confirmed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                            'completed' => 'bg-blue-50 text-blue-800 border-blue-200',
                                            'cancelled' => 'bg-rose-50 text-rose-800 border-rose-200',
                                            default => 'bg-amber-50 text-amber-800 border-amber-200',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badge }} uppercase">
                                        {{ $app->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $app->client_phone);
                                            if (str_starts_with($cleanPhone, '0')) {
                                                $cleanPhone = '60' . substr($cleanPhone, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $cleanPhone }}?text=Salam%20{{ urlencode($app->client_name) }},%20kami%20dari%20Sakeenah%20Medicare%20ingin%20mengesahkan%20tempahan%20sesi%20anda%20({{ $app->booking_code }})." 
                                           target="_blank" 
                                           rel="noopener noreferrer" 
                                           class="p-1 rounded-md text-emerald-600 hover:bg-emerald-50 transition" 
                                           title="WhatsApp Klien">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.appointments.show', $app->id) }}" 
                                           class="px-2.5 py-1 rounded-lg text-xs font-bold text-[#2D6A4F] bg-emerald-50/60 hover:bg-emerald-100 transition">
                                            Urus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-neutral-400">Tiada rekod tempahan dijumpai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Side Column: Recent Screeners & Quick Links (4 cols) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Quick Shortcuts --}}
            <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Pintasan Pantas Staf</h4>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('admin.services.create') }}" class="p-3 rounded-xl border border-neutral-200 hover:border-emerald-300 hover:bg-emerald-50/40 transition text-center group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-700">+ Perkhidmatan</span>
                        <span class="text-[10px] text-neutral-400">Katalog sesi</span>
                    </a>
                    <a href="{{ route('admin.practitioners.create') }}" class="p-3 rounded-xl border border-neutral-200 hover:border-emerald-300 hover:bg-emerald-50/40 transition text-center group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-700">+ Pakar Terapi</span>
                        <span class="text-[10px] text-neutral-400">Profil kaunselor</span>
                    </a>
                    <a href="{{ route('admin.articles.create') }}" class="p-3 rounded-xl border border-neutral-200 hover:border-emerald-300 hover:bg-emerald-50/40 transition text-center group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-emerald-700">+ Tulis Artikel</span>
                        <span class="text-[10px] text-neutral-400">Psikoedukasi</span>
                    </a>
                    <a href="{{ route('booking.index') }}" target="_blank" class="p-3 rounded-xl border border-neutral-200 hover:border-[#E07A5F] hover:bg-orange-50/40 transition text-center group">
                        <span class="block text-xs font-bold text-neutral-800 group-hover:text-[#E07A5F]">Borang Awam</span>
                        <span class="text-[10px] text-neutral-400">Tempah terus</span>
                    </a>
                </div>
            </div>

            {{-- Recent DASS-21 Submissions --}}
            <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-400">Saringan Minda Terkini</h4>
                    <a href="{{ route('admin.screeners.index') }}" class="text-[11px] font-bold text-[#2D6A4F] hover:underline">Semua &rarr;</a>
                </div>

                <div class="space-y-2.5">
                    @forelse($recentScreeners as $sc)
                        <a href="{{ route('admin.screeners.show', $sc->id) }}" class="block p-3 rounded-xl bg-neutral-50/60 hover:bg-neutral-100 transition border border-neutral-200/60">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-bold text-neutral-900 text-xs">{{ $sc->client_name ?: 'Responden Awam' }}</span>
                                <span class="text-[10px] text-neutral-400">{{ $sc->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-[10px]">
                                <span class="px-1.5 py-0.5 rounded bg-rose-50 text-rose-700 font-semibold border border-rose-200">
                                    D: {{ $sc->depression_severity }}
                                </span>
                                <span class="px-1.5 py-0.5 rounded bg-amber-50 text-amber-700 font-semibold border border-amber-200">
                                    A: {{ $sc->anxiety_severity }}
                                </span>
                                <span class="px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 font-semibold border border-blue-200">
                                    S: {{ $sc->stress_severity }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-neutral-400 text-center py-4">Tiada rekod saringan terkini.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@endsection


