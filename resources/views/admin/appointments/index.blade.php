@extends('layouts.admin')

@section('title', 'Senarai Tempahan Temu Janji | Sakeenah Medicare')
@section('page_title', 'Pengurusan Tempahan Temu Janji')

@section('admin_content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-neutral-900">Senarai Keseluruhan Tempahan</h2>
            <p class="text-xs text-neutral-500">Semak, sahkan, atau kemaskini status kehadiran pesakit dan bayaran deposit.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50 text-[11px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200/80">
                    <tr>
                        <th class="py-3.5 px-4">Kod Rujukan</th>
                        <th class="py-3.5 px-4">Nama Pesakit</th>
                        <th class="py-3.5 px-4">Perkhidmatan</th>
                        <th class="py-3.5 px-4">Mod Sesi</th>
                        <th class="py-3.5 px-4">Tarikh & Masa</th>
                        <th class="py-3.5 px-4">Pakar Bertugas</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Bayaran</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($appointments as $app)
                        <tr class="hover:bg-neutral-50/70 transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-neutral-900">{{ $app->booking_code }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900 block">{{ $app->client_name }}</span>
                                <span class="text-[11px] text-neutral-400">{{ $app->client_phone }}</span>
                            </td>
                            <td class="py-3.5 px-4">{{ $app->service->name }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $app->session_mode === 'in_person' ? 'bg-emerald-50 text-emerald-800' : 'bg-sky-50 text-sky-800' }}">
                                    {{ $app->session_mode === 'in_person' ? 'Bersemuka' : 'Tele-Terapi' }}
                                </span>
                            </td>
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
                            <td class="py-3.5 px-4">
                                <span class="text-[11px] font-semibold {{ $app->payment_status === 'paid' ? 'text-emerald-700' : 'text-neutral-500' }}">
                                    {{ ucfirst($app->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.appointments.show', $app->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-neutral-100 hover:bg-[#2D6A4F] hover:text-white font-bold transition text-[11px]">
                                    <span>Perincian</span>
                                    <span>&rarr;</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 text-center text-neutral-400">Tiada rekod tempahan dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-neutral-100">
            {{ $appointments->links() }}
        </div>
    </div>

</div>
@endsection

