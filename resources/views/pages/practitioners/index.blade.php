@extends('layouts.public')

@section('title', 'Pasukan Pakar Psikologi & Kaunselor | Sakeenah Medicare')

@section('content')
<div class="py-16 bg-[#F4F1EA]/60 border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <h1 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-3">Pakar & Terapis Kami</h1>
        <h2 class="text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">Pengamal Berdaftar & Bertauliah</h2>
        <p class="text-base text-neutral-600 leading-relaxed">
            Pasukan kami terdiri daripada Pakar Psikologi Klinikal dan Kaunselor Berdaftar yang berdedikasi membantu anda dan keluarga dengan pendekatan terapeutik berasaskan bukti saintifik (evidence-based).
        </p>
    </div>
</div>

<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($practitioners as $p)
                <div class="rounded-3xl border border-neutral-200/80 bg-white p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="w-40 h-40 mx-auto rounded-full overflow-hidden bg-neutral-100 border-4 border-emerald-50 mb-6">
                            <img src="{{ asset($p->photo_path) }}" 
                                 alt="{{ $p->name }}" 
                                 class="w-full h-full object-cover object-top">
                        </div>

                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold text-neutral-900">{{ $p->name }}</h3>
                            <p class="text-sm font-semibold text-[#2D6A4F] mt-1">{{ $p->title }}</p>
                            <span class="inline-block mt-1 text-xs text-neutral-500 font-mono bg-neutral-100 px-3 py-0.5 rounded-full">
                                No. Perakuan: {{ $p->registration_number }}
                            </span>
                        </div>

                        <p class="text-sm text-neutral-600 leading-relaxed mb-6">
                            {{ $p->bio }}
                        </p>

                        {{-- Specialties --}}
                        <div class="mb-6 space-y-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block">Pengkhususan:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @if(is_array($p->specialties))
                                    @foreach($p->specialties as $sp)
                                        <span class="text-xs font-medium text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md">
                                            {{ $sp }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Languages --}}
                        <div class="mb-6 space-y-1">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400 block">Bahasa Pengantar:</span>
                            <p class="text-xs text-neutral-600 font-medium">
                                {{ is_array($p->languages) ? implode(', ', $p->languages) : 'Bahasa Melayu, English' }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-neutral-100">
                        <a href="{{ route('booking.index') }}?practitioner={{ $p->slug }}" 
                           class="w-full py-3 rounded-full text-sm font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] transition text-center flex items-center justify-center gap-2">
                            <span>Pilih Slot Bersama {{ $p->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

