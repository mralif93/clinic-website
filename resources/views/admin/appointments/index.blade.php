@extends('layouts.admin')

@section('title', 'Senarai Tempahan Temu Janji | Sakeenah Medicare')
@section('page_title', 'Pengurusan Tempahan Temu Janji')

@section('admin_content')
<div class="space-y-6">
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-neutral-900 tracking-tight">Senarai Keseluruhan Tempahan</h2>
            <p class="text-xs text-neutral-500 mt-0.5">Semak, sahkan, atau kemaskini status kehadiran pesakit dan bayaran deposit.</p>
        </div>
    </div>

    {{-- Filter Tabs with Counters --}}
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <a href="{{ route('admin.appointments.index') }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ empty($currentStatus) ? 'bg-[#2D6A4F] text-white shadow-xs' : 'bg-white border border-neutral-200 text-neutral-600 hover:bg-neutral-50' }}">
            <span>Semua</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ empty($currentStatus) ? 'bg-white/20 text-white' : 'bg-neutral-100 text-neutral-700' }}">{{ $statusCounts['all'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-amber-700 hover:bg-amber-50/50' }}">
            <span>Perlu Tindakan</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'pending' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $statusCounts['pending'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', ['status' => 'confirmed']) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'confirmed' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white border border-neutral-200 text-emerald-700 hover:bg-emerald-50/50' }}">
            <span>Disahkan</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'confirmed' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $statusCounts['confirmed'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', ['status' => 'completed']) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'completed' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-blue-700 hover:bg-blue-50/50' }}">
            <span>Selesai</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'completed' ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-800' }}">{{ $statusCounts['completed'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', ['status' => 'cancelled']) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'cancelled' ? 'bg-rose-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-rose-700 hover:bg-rose-50/50' }}">
            <span>Batal</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'cancelled' ? 'bg-white/20 text-white' : 'bg-rose-100 text-rose-800' }}">{{ $statusCounts['cancelled'] }}</span>
        </a>
    </div>

    {{-- Main Table --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50/90 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                    <tr>
                        <th class="py-3.5 px-4">Kod Rujukan</th>
                        <th class="py-3.5 px-4">Nama Pesakit</th>
                        <th class="py-3.5 px-4">Perkhidmatan</th>
                        <th class="py-3.5 px-4">Mod</th>
                        <th class="py-3.5 px-4">Tarikh & Waktu</th>
                        <th class="py-3.5 px-4">Pakar</th>
                        <th class="py-3.5 px-4">Status</th>
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
                            <td class="py-3.5 px-4">
                                <span class="font-medium text-neutral-800 block">{{ $app->service->name }}</span>
                                <span class="text-[10px] text-emerald-600 font-semibold">Deposit: RM {{ number_format($app->service->deposit_amount, 2) }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $app->session_mode === 'in_person' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-sky-50 text-sky-800 border border-sky-200' }}">
                                    {{ $app->session_mode === 'in_person' ? 'Cyberjaya' : 'Online' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-semibold text-neutral-900 block">{{ $app->appointment_date->format('d/m/Y') }}</span>
                                <span class="text-[11px] text-neutral-400">{{ $app->appointment_time }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="text-neutral-700 font-medium">{{ $app->practitioner->name ?? 'Mana-mana Pakar' }}</span>
                            </td>
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
                                <div class="inline-flex items-center gap-1.5">
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $app->client_phone);
                                        if (str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '60' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}?text=Salam%20{{ urlencode($app->client_name) }},%20pihak%20Sakeenah%20Medicare%20ingin%20mengesahkan%20jadual%20sesi%20terapi%20anda%20({{ $app->booking_code }})." 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="p-1.5 rounded-lg text-emerald-600 hover:bg-emerald-50 transition border border-transparent hover:border-emerald-200" 
                                       title="WhatsApp Pesakit">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.appointments.show', $app->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-neutral-100 hover:bg-[#2D6A4F] hover:text-white font-bold transition text-xs">
                                        <span>Perincian</span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-neutral-400">
                                Tiada rekod tempahan untuk kategori status ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($appointments->hasPages())
            <div class="p-4 border-t border-neutral-100">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

</div>
@endsection


