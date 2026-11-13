@extends('layouts.admin')

@section('title', 'Log Respons Ujian DASS-21 | Sakeenah Medicare')
@section('page_title', 'Log Respons Saringan DASS-21')

@section('admin_content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-neutral-900 tracking-tight">Rekod Ujian Saringan Klien</h2>
            <p class="text-xs text-neutral-500 mt-0.5">Hasil saringan kendiri minda DASS-21 yang telah dihantar oleh pelawat.</p>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200/90 shadow-2xs space-y-3">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
            <div class="flex items-center gap-2 text-neutral-800">
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Carian & Tapisan Rekod</h3>
            </div>
            <span class="text-[11px] text-neutral-400">Tapis hasil ujian mengikut kata kunci dan tahap keterukan</span>
        </div>

        <form method="GET" action="{{ route('admin.screeners.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 pt-0.5">
            {{-- Keyword Search --}}
            <div class="grow relative">
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari nama responden, telefon, emel, ID..." 
                       class="w-full h-10 pl-9 pr-3.5 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition placeholder:text-neutral-400">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            {{-- Filter by Severity --}}
            <div class="w-full md:w-56 relative shrink-0">
                <select name="severity" class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="">Semua Tahap Keterukan</option>
                    @foreach(['Normal', 'Mild', 'Moderate', 'Severe', 'Extremely Severe'] as $sev)
                        <option value="{{ $sev }}" {{ $selectedSeverity === $sev ? 'selected' : '' }}>
                            {{ $sev }}
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
                @if($search || $selectedSeverity)
                    <a href="{{ route('admin.screeners.index') }}" class="h-10 px-3.5 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50/90 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                    <tr>
                        <th class="py-3.5 px-4 min-w-[70px]">ID</th>
                        <th class="py-3.5 px-4 min-w-[200px]">Nama / Rujukan</th>
                        <th class="py-3.5 px-4 min-w-[150px]">Kemurungan (Depression)</th>
                        <th class="py-3.5 px-4 min-w-[150px]">Kebimbangan (Anxiety)</th>
                        <th class="py-3.5 px-4 min-w-[150px]">Tekanan (Stress)</th>
                        <th class="py-3.5 px-4 min-w-[120px]">Tarikh Ujian</th>
                        <th class="py-3.5 px-4 text-right min-w-[90px]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($screeners as $sc)
                        <tr class="hover:bg-neutral-50/70 transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-neutral-900">#{{ $sc->id }}</td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900 block">{{ $sc->client_name ?: 'Pelawat Tanpa Nama' }}</span>
                                <span class="text-[11px] text-neutral-400">{{ $sc->client_phone ?: $sc->client_email ?: 'Tiada info hubungan' }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900">{{ $sc->depression_score }}</span>
                                <span class="text-[11px] font-semibold block {{ in_array($sc->depression_severity, ['Severe', 'Extremely Severe']) ? 'text-rose-600' : 'text-neutral-500' }}">({{ $sc->depression_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900">{{ $sc->anxiety_score }}</span>
                                <span class="text-[11px] font-semibold block {{ in_array($sc->anxiety_severity, ['Severe', 'Extremely Severe']) ? 'text-rose-600' : 'text-neutral-500' }}">({{ $sc->anxiety_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900">{{ $sc->stress_score }}</span>
                                <span class="text-[11px] font-semibold block {{ in_array($sc->stress_severity, ['Severe', 'Extremely Severe']) ? 'text-rose-600' : 'text-neutral-500' }}">({{ $sc->stress_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500">
                                {{ $sc->created_at->format('d/m/Y, h:i A') }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.screeners.show', $sc->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-neutral-200 text-xs font-bold text-neutral-700 hover:bg-neutral-100 transition">
                                    Lihat &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-neutral-400">
                                <p class="text-xs">Tiada rekod saringan dijumpai bagi kriteria carian atau tapisan ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($screeners->hasPages())
            <div class="p-4 border-t border-neutral-100">
                {{ $screeners->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
