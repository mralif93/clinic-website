@extends('layouts.public')

@section('title', $service->name . ' | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] hover:underline mb-4">
            &larr; Kembali ke Senarai Perkhidmatan
        </a>
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-[#2D6A4F] uppercase">
                {{ $service->target_audience }}
            </span>
            <span class="text-xs text-neutral-400">• Tempoh: {{ $service->duration_minutes }} Minit</span>
            @if($service->allows_online)
                <span class="text-xs text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full font-medium">Boleh Online</span>
            @endif
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-neutral-900 tracking-tight leading-tight">
            {{ $service->name }}
        </h1>
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-28 sm:pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        @if($service->image_path)
            <div class="rounded-3xl overflow-hidden shadow-sm max-h-96 w-full bg-neutral-100">
                <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="text-neutral-700 leading-relaxed space-y-6 text-sm sm:text-base">
            <p class="text-base sm:text-lg font-medium text-neutral-800 leading-relaxed border-l-4 border-[#2D6A4F] pl-4 bg-neutral-50 py-3 rounded-r-2xl">
                {{ $service->summary }}
            </p>

            <div class="space-y-4">
                {!! nl2br(e($service->description)) !!}
            </div>
        </div>

        {{-- Booking Box --}}
        <div class="rounded-3xl bg-neutral-50 border border-neutral-200/90 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <span class="text-xs text-neutral-500 block">Kadar Yuran Sesi:</span>
                <strong class="text-2xl font-extrabold text-neutral-900 block">
                    {{ $service->price > 0 ? 'RM ' . number_format($service->price, 2) : 'Berdasarkan Sebut Harga' }}
                </strong>
                @if($service->deposit_amount > 0)
                    <span class="text-xs text-neutral-400">Deposit pengesahan slot: RM {{ number_format($service->deposit_amount, 2) }}</span>
                @endif
            </div>

            <a href="{{ route('booking.index') }}?service={{ $service->slug }}" 
               class="px-8 py-3.5 rounded-full text-sm font-bold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow-md transition whitespace-nowrap">
                Pilih & Tempah Slot Sesi
            </a>
        </div>

    </div>
</div>
@endsection

