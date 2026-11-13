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
        <a href="{{ route('admin.appointments.index', array_filter(['q' => request('q'), 'service_id' => request('service_id'), 'practitioner_id' => request('practitioner_id'), 'mode' => request('mode')])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ empty($currentStatus) ? 'bg-[#2D6A4F] text-white shadow-xs' : 'bg-white border border-neutral-200 text-neutral-600 hover:bg-neutral-50' }}">
            <span>Semua</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ empty($currentStatus) ? 'bg-white/20 text-white' : 'bg-neutral-100 text-neutral-700' }}">{{ $statusCounts['all'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', array_filter(['status' => 'pending', 'q' => request('q'), 'service_id' => request('service_id'), 'practitioner_id' => request('practitioner_id'), 'mode' => request('mode')])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-amber-700 hover:bg-amber-50/50' }}">
            <span>Perlu Tindakan</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'pending' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $statusCounts['pending'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', array_filter(['status' => 'confirmed', 'q' => request('q'), 'service_id' => request('service_id'), 'practitioner_id' => request('practitioner_id'), 'mode' => request('mode')])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'confirmed' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-white border border-neutral-200 text-emerald-700 hover:bg-emerald-50/50' }}">
            <span>Disahkan</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'confirmed' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $statusCounts['confirmed'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', array_filter(['status' => 'completed', 'q' => request('q'), 'service_id' => request('service_id'), 'practitioner_id' => request('practitioner_id'), 'mode' => request('mode')])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'completed' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-blue-700 hover:bg-blue-50/50' }}">
            <span>Selesai</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'completed' ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-800' }}">{{ $statusCounts['completed'] }}</span>
        </a>

        <a href="{{ route('admin.appointments.index', array_filter(['status' => 'cancelled', 'q' => request('q'), 'service_id' => request('service_id'), 'practitioner_id' => request('practitioner_id'), 'mode' => request('mode')])) }}" 
           class="px-3.5 py-2 rounded-xl font-bold transition whitespace-nowrap flex items-center gap-2 {{ $currentStatus === 'cancelled' ? 'bg-rose-600 text-white shadow-xs' : 'bg-white border border-neutral-200 text-rose-700 hover:bg-rose-50/50' }}">
            <span>Batal</span>
            <span class="px-1.5 py-0.2 rounded-md text-[10px] {{ $currentStatus === 'cancelled' ? 'bg-white/20 text-white' : 'bg-rose-100 text-rose-800' }}">{{ $statusCounts['cancelled'] }}</span>
        </a>
    </div>

    {{-- Search & Advanced Filter Card --}}
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200/90 shadow-2xs space-y-3">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
            <div class="flex items-center gap-2 text-neutral-800">
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Carian & Tapisan Tempahan</h3>
            </div>
            <span class="text-[11px] text-neutral-400">Cari mengikut nama klien, pakej terapi atau pakar yang ditugaskan</span>
        </div>

        <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 pt-0.5">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            {{-- Keyword Search --}}
            <div class="grow relative">
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari nama klien, telefon, kod SKM-..." 
                       class="w-full h-10 pl-9 pr-3.5 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition placeholder:text-neutral-400">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            {{-- Filter by Service --}}
            <div class="w-full md:w-52 relative shrink-0">
                <select name="service_id" class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="">Semua Perkhidmatan</option>
                    @foreach($services as $s)
                        <option value="{{ $s->id }}" {{ (string)$serviceId === (string)$s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Filter by Practitioner --}}
            <div class="w-full md:w-48 relative shrink-0">
                <select name="practitioner_id" class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="">Semua Pakar</option>
                    @foreach($practitioners as $p)
                        <option value="{{ $p->id }}" {{ (string)$practitionerId === (string)$p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Submit & Reset Buttons --}}
            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" class="h-10 px-5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-xs font-bold text-white shadow-2xs transition flex items-center justify-center gap-1.5 grow md:grow-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Tapis</span>
                </button>
                @if($search || $serviceId || $practitionerId || $mode || request('status'))
                    <a href="{{ route('admin.appointments.index') }}" class="h-10 px-3.5 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Main Table --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50/90 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                    <tr>
                        <th class="py-3.5 px-4 min-w-[130px]">Kod Rujukan</th>
                        <th class="py-3.5 px-4 min-w-[200px]">Klien & Hubungan</th>
                        <th class="py-3.5 px-4 min-w-[180px]">Pakej & Pakar</th>
                        <th class="py-3.5 px-4 min-w-[150px]">Tarikh & Masa</th>
                        <th class="py-3.5 px-4 min-w-[110px]">Status Sesi</th>
                        <th class="py-3.5 px-4 min-w-[140px]">Bayaran Deposit</th>
                        <th class="py-3.5 px-4 text-right min-w-[100px]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($appointments as $app)
                        <tr class="hover:bg-neutral-50/70 transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-neutral-900">
                                <a href="{{ route('admin.appointments.show', $app->id) }}" class="text-[#2D6A4F] hover:underline">
                                    {{ $app->booking_code }}
                                </a>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900 block">{{ $app->client_name }}</span>
                                <span class="text-[11px] text-neutral-400 block">{{ $app->client_phone }} &bull; {{ $app->client_email }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-medium text-neutral-900 block">{{ $app->service->name }}</span>
                                <span class="text-[11px] text-neutral-500">Pakar: {{ $app->practitioner->name ?? 'Belum Ditugaskan' }}</span>
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
                                        'pending' => 'Perlu Tindakan',
                                        'confirmed' => 'Disahkan',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Batal',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $badgeStyles[$app->status] ?? 'bg-neutral-100 text-neutral-700 border-neutral-200' }}">
                                    {{ $badgeLabels[$app->status] ?? ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div>
                                    <span class="font-bold text-neutral-800 block">RM {{ number_format($app->deposit_amount, 2) }}</span>
                                    <span class="text-[10px] font-bold {{ $app->payment_status === 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                                        {{ $app->payment_status === 'paid' ? '● Telah Dibayar' : '○ Menunggu Bayaran' }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.appointments.show', $app->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-neutral-200 text-xs font-bold text-neutral-700 hover:bg-neutral-100 hover:border-neutral-300 transition">
                                    <span>Urus</span>
                                    <span>&rarr;</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-neutral-400">
                                <p class="text-xs">Tiada rekod tempahan dijumpai bagi kriteria carian atau tapisan ini.</p>
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
