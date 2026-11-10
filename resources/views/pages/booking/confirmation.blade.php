@extends('layouts.public')

@section('title', 'Pengesahan Tempahan Sesi | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-[#F4F1EA]/60 border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-[#2D6A4F] mx-auto flex items-center justify-center mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-[#2D6A4F] text-xs font-bold uppercase tracking-wider mb-2">
            Permintaan Diterima
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Tempahan Berjaya Didaftarkan</h1>
        <p class="text-sm text-neutral-600 mt-2">Nombor Rujukan Tempahan Anda: <strong class="text-[#2D6A4F] font-mono text-base">{{ $appointment->booking_code }}</strong></p>
    </div>
</div>

<div class="py-16 bg-white pb-24 sm:pb-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-neutral-200/90 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            <h2 class="text-lg font-bold text-neutral-900 border-b border-neutral-100 pb-3">Ringkasan Temu Janji</h2>

            <div class="grid grid-cols-2 gap-4 text-xs sm:text-sm">
                <div>
                    <span class="text-neutral-500 block">Nama Klien:</span>
                    <strong class="text-neutral-900">{{ $appointment->client_name }}</strong>
                </div>
                <div>
                    <span class="text-neutral-500 block">No. Telefon:</span>
                    <strong class="text-neutral-900">{{ $appointment->client_phone }}</strong>
                </div>
                <div>
                    <span class="text-neutral-500 block">Perkhidmatan:</span>
                    <strong class="text-neutral-900">{{ $appointment->service->name }}</strong>
                </div>
                <div>
                    <span class="text-neutral-500 block">Mod Sesi:</span>
                    <strong class="text-neutral-900">{{ $appointment->session_mode === 'in_person' ? 'Bersemuka di Cyberjaya' : 'Tele-Terapi (Online)' }}</strong>
                </div>
                <div>
                    <span class="text-neutral-500 block">Tarikh Cadangan:</span>
                    <strong class="text-neutral-900">{{ $appointment->appointment_date->format('d M Y') }}</strong>
                </div>
                <div>
                    <span class="text-neutral-500 block">Masa:</span>
                    <strong class="text-neutral-900">{{ $appointment->appointment_time }}</strong>
                </div>
                @if($appointment->practitioner)
                    <div class="col-span-2">
                        <span class="text-neutral-500 block">Pakar Pilihan:</span>
                        <strong class="text-neutral-900">{{ $appointment->practitioner->name }} ({{ $appointment->practitioner->title }})</strong>
                    </div>
                @endif
                <div class="col-span-2 pt-2 border-t border-neutral-100 flex justify-between items-center">
                    <div>
                        <span class="text-neutral-500 block">Deposit Pengesahan Slot:</span>
                        <strong class="text-lg font-bold text-[#2D6A4F]">RM {{ number_format($appointment->deposit_amount, 2) }}</strong>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Menunggu Pengesahan</span>
                </div>
            </div>

            <div class="rounded-2xl bg-emerald-50/60 border border-emerald-200/80 p-4 text-xs text-neutral-600 leading-relaxed">
                <strong class="text-[#2D6A4F] block mb-1">Langkah Seterusnya:</strong>
                Pasukan pentadbiran klinik kami sedang menyemak ketersediaan kalendar. Salinan pengesahan dan invois pembayaran deposit akan dihantar melalui WhatsApp ke <span class="font-bold text-neutral-800">{{ $appointment->client_phone }}</span> sebentar lagi.
            </div>

            <div class="pt-4 flex flex-col sm:flex-row gap-3">
                @php
                    $waText = urlencode("Salam Sakeenah Medicare, saya baru membuat tempahan slot (Kod: {$appointment->booking_code}) untuk sesi {$appointment->service->name} pada {$appointment->appointment_date->format('d/m/Y')} ({$appointment->appointment_time}).");
                @endphp
                <a href="https://wa.me/601170352636?text={{ $waText }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="w-full text-center py-3.5 rounded-full text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                    <span>Hubungi WhatsApp Rasmi Klinik</span>
                </a>

                <a href="{{ route('home') }}" class="w-full text-center py-3.5 rounded-full text-sm font-semibold text-neutral-700 bg-neutral-100 hover:bg-neutral-200 transition">
                    Kembali ke Laman Utama
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

