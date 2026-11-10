@extends('layouts.public')

@section('title', 'Keputusan Analisis Saringan DASS-21 | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-[#2D6A4F] text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5">
            Keputusan Analisis Kendiri
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Status Emosi & Minda Anda</h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-2">Dianalisis mengikut norma klinikal antarabangsa DASS-21.</p>
    </div>
</div>

<div class="py-12 sm:py-16 bg-[#FBFBFB] pb-28 sm:pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        {{-- 3 Category Score Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Depression --}}
            <div class="rounded-3xl border border-neutral-200/90 bg-white p-6 shadow-sm flex flex-col justify-between text-center">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-2">Kemurungan (Depression)</span>
                    <div class="text-4xl font-extrabold text-neutral-900 mb-2">{{ $screener->depression_score }}</div>
                    @php
                        $colorDep = match($screener->depression_severity) {
                            'Normal' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            'Ringan' => 'bg-amber-50 text-amber-800 border-amber-200',
                            'Sederhana' => 'bg-orange-50 text-orange-800 border-orange-200',
                            default => 'bg-rose-50 text-rose-800 border-rose-200',
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $colorDep }} mb-4">
                        Tahap: {{ $screener->depression_severity }}
                    </span>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Mengukur kecenderungan rasa putus asa, kehilangan minat terhadap aktiviti harian, dan rendah diri.
                    </p>
                </div>
            </div>

            {{-- Anxiety --}}
            <div class="rounded-3xl border border-neutral-200/90 bg-white p-6 shadow-sm flex flex-col justify-between text-center">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-2">Kebimbangan (Anxiety)</span>
                    <div class="text-4xl font-extrabold text-neutral-900 mb-2">{{ $screener->anxiety_score }}</div>
                    @php
                        $colorAnx = match($screener->anxiety_severity) {
                            'Normal' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            'Ringan' => 'bg-amber-50 text-amber-800 border-amber-200',
                            'Sederhana' => 'bg-orange-50 text-orange-800 border-orange-200',
                            default => 'bg-rose-50 text-rose-800 border-rose-200',
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $colorAnx }} mb-4">
                        Tahap: {{ $screener->anxiety_severity }}
                    </span>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Mengukur simptom fizikal seperti jantung berdebar, gementar, rasa panik, dan kerisauan berlebihan.
                    </p>
                </div>
            </div>

            {{-- Stress --}}
            <div class="rounded-3xl border border-neutral-200/90 bg-white p-6 shadow-sm flex flex-col justify-between text-center">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block mb-2">Tekanan (Stress)</span>
                    <div class="text-4xl font-extrabold text-neutral-900 mb-2">{{ $screener->stress_score }}</div>
                    @php
                        $colorStr = match($screener->stress_severity) {
                            'Normal' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            'Ringan' => 'bg-amber-50 text-amber-800 border-amber-200',
                            'Sederhana' => 'bg-orange-50 text-orange-800 border-orange-200',
                            default => 'bg-rose-50 text-rose-800 border-rose-200',
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $colorStr }} mb-4">
                        Tahap: {{ $screener->stress_severity }}
                    </span>
                    <p class="text-xs text-neutral-500 leading-relaxed">
                        Mengukur ketegangan fizikal, mudah gelisah, sukar bertenang, dan sensitif terhadap tekanan harian.
                    </p>
                </div>
            </div>

        </div>

        {{-- Clinical Interpretation Note --}}
        <div class="rounded-3xl bg-white border border-neutral-200/90 p-6 sm:p-8 space-y-4">
            <h3 class="text-lg font-bold text-neutral-900">Apa Maksud Keputusan Ini Untuk Anda?</h3>
            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">
                Ujian DASS-21 ini adalah alat saringan awal dan <strong>bukan pengesahan diagnosis perubatan rasmi</strong>. Skor yang berada pada tahap sederhana atau tinggi menunjukkan anda sedang menanggung beban emosi yang wajar mendapat perhatian profesional agar tidak berlarutan.
            </p>
            <div class="pt-3 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-xs text-neutral-500">Anda tidak perlu menanggung perasaan ini bersendirian.</span>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('booking.index') }}" 
                       class="w-full sm:w-auto px-6 py-3 rounded-full text-xs sm:text-sm font-bold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow transition text-center">
                        Bincang Keputusan Bersama Pakar Kami
                    </a>
                </div>
            </div>
        </div>

        {{-- Recommended Services --}}
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-neutral-900">Cadangan Terapi Bersesuaian Untuk Anda</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($services as $svc)
                    <div class="p-5 rounded-2xl border border-neutral-200/80 bg-white flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded uppercase">{{ $svc->target_audience }}</span>
                            <h4 class="text-base font-bold text-neutral-900 mt-2 mb-1">{{ $svc->name }}</h4>
                            <p class="text-xs text-neutral-600 line-clamp-2 leading-relaxed mb-3">{{ $svc->summary }}</p>
                        </div>
                        <a href="{{ route('booking.index') }}?service={{ $svc->slug }}" class="text-xs font-bold text-[#2D6A4F] hover:underline flex items-center gap-1">
                            Pilih Sesi Ini <span>&rarr;</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

