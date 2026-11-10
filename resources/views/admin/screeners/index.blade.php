@extends('layouts.admin')

@section('title', 'Log Respons Ujian DASS-21 | Sakeenah Medicare')
@section('page_title', 'Log Respons Saringan DASS-21')

@section('admin_content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-neutral-900">Rekod Ujian Saringan Klien</h2>
            <p class="text-xs text-neutral-500">Hasil saringan kendiri minda DASS-21 yang telah dihantar oleh pelawat.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50 text-[11px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200/80">
                    <tr>
                        <th class="py-3.5 px-4">ID</th>
                        <th class="py-3.5 px-4">Nama / Rujukan</th>
                        <th class="py-3.5 px-4">Kemurungan (Depression)</th>
                        <th class="py-3.5 px-4">Kebimbangan (Anxiety)</th>
                        <th class="py-3.5 px-4">Tekanan (Stress)</th>
                        <th class="py-3.5 px-4">Tarikh Ujian</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
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
                                <span class="text-[11px] text-neutral-500">({{ $sc->depression_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900">{{ $sc->anxiety_score }}</span>
                                <span class="text-[11px] text-neutral-500">({{ $sc->anxiety_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-neutral-900">{{ $sc->stress_score }}</span>
                                <span class="text-[11px] text-neutral-500">({{ $sc->stress_severity }})</span>
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500">
                                {{ $sc->created_at->format('d/m/Y h:i A') }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.screeners.show', $sc->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-neutral-100 hover:bg-[#2D6A4F] hover:text-white font-bold transition text-[11px]">
                                    Lihat Jawapan &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-neutral-400">Tiada rekod saringan dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-neutral-100">
            {{ $screeners->links() }}
        </div>
    </div>

</div>
@endsection

