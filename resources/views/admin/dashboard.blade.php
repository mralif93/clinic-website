@extends('layouts.admin')

@section('title', 'Papan Pemuka Pentadbiran | Sakeenah Medicare')
@section('page_title', 'Papan Pemuka Pentadbiran Klinik')

@section('admin_content')
<div class="space-y-8">
    
    {{-- Metric Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-1">Jumlah Tempahan</span>
            <div class="text-3xl font-extrabold text-neutral-900">{{ $totalAppointments }}</div>
            <span class="text-[11px] text-neutral-500 mt-1 block">Semua sesi direkodkan</span>
        </div>

        <div class="p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-600 block mb-1">Menunggu Pengesahan</span>
            <div class="text-3xl font-extrabold text-amber-600">{{ $pendingAppointments }}</div>
            <span class="text-[11px] text-neutral-500 mt-1 block">Perlu tindakan staf</span>
        </div>

        <div class="p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 block mb-1">Slot Disahkan</span>
            <div class="text-3xl font-extrabold text-emerald-600">{{ $confirmedAppointments }}</div>
            <span class="text-[11px] text-neutral-500 mt-1 block">Deposit / Jadual dikunci</span>
        </div>

        <div class="p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#2A6F97] block mb-1">Saringan DASS-21</span>
            <div class="text-3xl font-extrabold text-[#2A6F97]">{{ $totalScreeners }}</div>
            <span class="text-[11px] text-neutral-500 mt-1 block">Ujian kendiri selesai</span>
        </div>
    </div>

    {{-- Recent Appointments Table --}}
    <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 shadow-2xs space-y-4">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-neutral-900">Tempahan Sesi Terkini</h3>
                <p class="text-xs text-neutral-500">Senarai pesakit yang baru menempah sesi temu janji.</p>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-[#2D6A4F] hover:underline">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50 text-[11px] uppercase tracking-wider font-bold text-neutral-500 border-y border-neutral-200/80">
                    <tr>
                        <th class="py-3 px-4">Kod</th>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4">Perkhidmatan</th>
                        <th class="py-3 px-4">Tarikh & Masa</th>
                        <th class="py-3 px-4">Pakar</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($recentAppointments as $app)
                        <tr class="hover:bg-neutral-50/60 transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-neutral-900">{{ $app->booking_code }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900 block">{{ $app->client_name }}</span>
                                <span class="text-[11px] text-neutral-400">{{ $app->client_phone }}</span>
                            </td>
                            <td class="py-3.5 px-4">{{ $app->service->name }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-semibold text-neutral-900 block">{{ $app->appointment_date->format('d/m/Y') }}</span>
                                <span class="text-[11px] text-neutral-400">{{ $app->appointment_time }}</span>
                            </td>
                            <td class="py-3.5 px-4">{{ $app->practitioner->name ?? 'Mana-mana Pakar' }}</td>
                            <td class="py-3.5 px-4">
                                @php
                                    $badge = match($app->status) {
                                        'confirmed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                        'completed' => 'bg-blue-50 text-blue-800 border-blue-200',
                                        'cancelled' => 'bg-rose-50 text-rose-800 border-rose-200',
                                        default => 'bg-amber-50 text-amber-800 border-amber-200',
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badge }} uppercase">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.appointments.show', $app->id) }}" class="text-xs font-bold text-[#2D6A4F] hover:underline">
                                    Urus
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-neutral-400">Tiada rekod tempahan dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

