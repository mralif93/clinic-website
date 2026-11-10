@extends('layouts.public')

@section('title', $practitioner->name . ' - ' . $practitioner->title . ' | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('practitioners.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] hover:underline mb-4">
            &larr; Kembali ke Pasukan Pakar
        </a>
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-28 sm:pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            <div class="md:col-span-4 text-center">
                <div class="w-48 h-48 mx-auto rounded-full overflow-hidden bg-neutral-100 border-4 border-emerald-50 mb-4 shadow-sm">
                    <img src="{{ asset($practitioner->photo_path) }}" alt="{{ $practitioner->name }}" class="w-full h-full object-cover object-top">
                </div>
                <span class="inline-block text-xs font-mono text-neutral-500 bg-neutral-100 px-3 py-1 rounded-full">
                    {{ $practitioner->registration_number }}
                </span>
            </div>

            <div class="md:col-span-8 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-[#2D6A4F] bg-emerald-50 px-3 py-1 rounded-full">
                    Pengamal Berdaftar
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900">{{ $practitioner->name }}</h1>
                <p class="text-base font-semibold text-[#2D6A4F]">{{ $practitioner->title }}</p>

                <div class="text-sm text-neutral-600 leading-relaxed pt-2">
                    {!! nl2br(e($practitioner->bio)) !!}
                </div>

                {{-- Specialties --}}
                <div class="pt-4 space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block">Bidang Pengkhususan:</span>
                    <div class="flex flex-wrap gap-2">
                        @if(is_array($practitioner->specialties))
                            @foreach($practitioner->specialties as $sp)
                                <span class="px-3 py-1 rounded-lg text-xs font-medium text-emerald-800 bg-emerald-50 border border-emerald-200/60">
                                    {{ $sp }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('booking.index') }}?practitioner={{ $practitioner->slug }}" 
                       class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-sm font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow transition">
                        <span>Pilih Slot Bersama {{ $practitioner->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

