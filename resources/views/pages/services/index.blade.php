@extends('layouts.public')

@section('title', 'Perkhidmatan Klinikal & Terapi | Sakeenah Medicare')

@section('content')
<div class="py-16 bg-[#F4F1EA]/60 border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <h1 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-3">Perkhidmatan Kami</h1>
        <h2 class="text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">Sokongan Kesihatan Mental Menyeluruh</h2>
        <p class="text-base text-neutral-600 leading-relaxed">
            Daripada penilaian awal autisme dan ADHD, terapi individu, kaunseling perkahwinan sehinggalah ke program kesihatan pekerja organisasi.
        </p>
    </div>
</div>

<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        @foreach($services as $service)
            <div class="rounded-3xl border border-neutral-200/80 bg-white p-8 lg:p-10 shadow-sm hover:shadow-md transition grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-4 h-64 rounded-2xl overflow-hidden bg-neutral-100">
                    <img src="{{ asset($service->image_path ?? 'media/services/Better-therapy-thumbnail.jpg') }}" 
                         alt="{{ $service->name }}" 
                         class="w-full h-full object-cover">
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full">
                            {{ $service->target_audience }}
                        </span>
                        <span class="text-xs text-neutral-500">
                            ⏱ Tempoh: {{ $service->duration_minutes }} minit
                        </span>
                        @if($service->allows_online)
                            <span class="text-xs text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full font-medium">Boleh Online (Tele-terapi)</span>
                        @endif
                        @if($service->allows_in_person)
                            <span class="text-xs text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full font-medium">Sesi Bersemuka Cyberjaya</span>
                        @endif
                    </div>

                    <h3 class="text-2xl font-bold text-neutral-900">{{ $service->name }}</h3>
                    <p class="text-sm text-neutral-600 leading-relaxed">{{ $service->summary }}</p>
                    <p class="text-sm text-neutral-500 leading-relaxed">{{ $service->description }}</p>

                    <div class="pt-4 flex flex-wrap items-center justify-between gap-4 border-t border-neutral-100">
                        <div>
                            <span class="text-xs text-neutral-400 block">Anggaran Yuran:</span>
                            <span class="text-xl font-bold text-neutral-900">
                                {{ $service->price > 0 ? 'RM ' . number_format($service->price, 2) : 'Berdasarkan Sebut Harga' }}
                            </span>
                            @if($service->deposit_amount > 0)
                                <span class="text-xs text-neutral-500 block">(Deposit pengesahan slot: RM {{ number_format($service->deposit_amount, 2) }})</span>
                            @endif
                        </div>

                        <a href="{{ route('booking.index') }}?service={{ $service->slug }}" 
                           class="px-6 py-3 rounded-full text-sm font-bold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow transition flex items-center gap-2">
                            <span>Tempah Sesi Ini</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

