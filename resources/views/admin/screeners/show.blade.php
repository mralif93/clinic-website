@extends('layouts.admin')

@section('title', 'Perincian Jawapan Saringan #' . $screener->id . ' | Sakeenah Medicare')
@section('page_title', 'Perincian Saringan DASS-21 #' . $screener->id)

@section('admin_content')
<div class="max-w-4xl space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.screeners.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1">
            &larr; Kembali ke Senarai Saringan
        </a>
        <span class="text-xs text-neutral-400">Tarikh ujian: {{ $screener->created_at->format('d M Y, h:i A') }}</span>
    </div>

    {{-- Score Overview --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs text-center">
            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-1">Kemurungan</span>
            <div class="text-3xl font-extrabold text-neutral-900 mb-1">{{ $screener->depression_score }}</div>
            <span class="inline-block px-3 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                {{ $screener->depression_severity }}
            </span>
        </div>

        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs text-center">
            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-1">Kebimbangan</span>
            <div class="text-3xl font-extrabold text-neutral-900 mb-1">{{ $screener->anxiety_score }}</div>
            <span class="inline-block px-3 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                {{ $screener->anxiety_severity }}
            </span>
        </div>

        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-2xs text-center">
            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-1">Tekanan</span>
            <div class="text-3xl font-extrabold text-neutral-900 mb-1">{{ $screener->stress_score }}</div>
            <span class="inline-block px-3 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                {{ $screener->stress_severity }}
            </span>
        </div>
    </div>

    {{-- Client Contact Info (if any) --}}
    @if($screener->client_name || $screener->client_phone || $screener->client_email)
        <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs">
            <h3 class="text-sm font-bold text-neutral-900 mb-3">Maklumat Pelawat / Klien</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <span class="text-neutral-400 block mb-0.5">Nama:</span>
                    <strong class="text-neutral-900">{{ $screener->client_name ?: 'Tidak dinyatakan' }}</strong>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">No. WhatsApp:</span>
                    <strong class="text-emerald-700">{{ $screener->client_phone ?: 'Tidak dinyatakan' }}</strong>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">Emel:</span>
                    <strong class="text-neutral-900">{{ $screener->client_email ?: 'Tidak dinyatakan' }}</strong>
                </div>
            </div>
        </div>
    @endif

    {{-- Detailed 21 Questions Answers --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-8 space-y-4 shadow-2xs">
        <h3 class="text-base font-bold text-neutral-900 border-b border-neutral-100 pb-3">Pecahan Jawapan Klien (21 Soalan)</h3>

        @php
            $questions = \App\Http\Controllers\ScreenerController::QUESTIONS;
            $answers = is_array($screener->answers) ? $screener->answers : [];
        @endphp

        <div class="space-y-2.5">
            @foreach($questions as $id => $q)
                @php
                    $val = $answers[$id] ?? 0;
                    $valText = match((int)$val) {
                        0 => 'Tidak langsung (0)',
                        1 => 'Sedikit / Jarang (1)',
                        2 => 'Kerap / Banyak (2)',
                        3 => 'Sangat kerap / Sentiasa (3)',
                        default => (string)$val,
                    };
                @endphp
                <div class="p-3 sm:p-3.5 rounded-xl bg-neutral-50 flex flex-col sm:flex-row sm:items-center justify-between text-xs gap-2 sm:gap-3">
                    <span class="text-neutral-800 leading-relaxed">
                        <strong class="font-mono text-[#2D6A4F] mr-1.5">{{ $id }}.</strong>
                        {{ $q['text'] }}
                        <span class="text-[10px] text-neutral-400 uppercase font-mono ml-1">[{{ $q['scale'] }}]</span>
                    </span>
                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold shrink-0 self-start sm:self-auto {{ (int)$val >= 2 ? 'bg-amber-100 text-amber-900' : 'bg-white text-neutral-700 border border-neutral-200' }}">
                        {{ $valText }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

