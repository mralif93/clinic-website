@extends('layouts.public')

@section('title', 'Pengesahan Tempahan Sesi | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-[#F4F1EA]/60 border-b border-neutral-200/60">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-[#2D6A4F] mx-auto flex items-center justify-center mb-4 shadow-xs">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-[#2D6A4F] text-xs font-bold uppercase tracking-wider mb-2">
            Permintaan Diterima
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Tempahan Berjaya Didaftarkan</h1>
        <p class="text-sm text-neutral-600 mt-2">Nombor Rujukan Tempahan Anda: <strong class="text-[#2D6A4F] font-mono text-base">{{ $appointment->booking_code }}</strong></p>
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-24 sm:pb-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('status'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        {{-- Booking Summary Card --}}
        <div class="rounded-3xl border border-neutral-200/90 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-neutral-100 pb-3">
                <h2 class="text-lg font-bold text-neutral-900">Ringkasan Temu Janji</h2>
                @php
                    $statusBadge = match($appointment->status) {
                        'confirmed' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'label' => 'Disahkan'],
                        'completed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'label' => 'Selesai'],
                        'cancelled' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-800', 'label' => 'Dibatalkan'],
                        default => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'label' => 'Menunggu Pengesahan'],
                    };
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge['bg'] }} {{ $statusBadge['text'] }}">
                    {{ $statusBadge['label'] }}
                </span>
            </div>

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
                    <span class="text-neutral-500 block">Emel:</span>
                    <strong class="text-neutral-900">{{ $appointment->client_email }}</strong>
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
                <div>
                    <span class="text-neutral-500 block">Status Bayaran Deposit:</span>
                    <span class="inline-flex items-center gap-1.5 font-bold {{ $appointment->deposit_receipt ? 'text-emerald-700' : 'text-amber-700' }}">
                        <span class="w-2 h-2 rounded-full {{ $appointment->deposit_receipt ? 'bg-emerald-600' : 'bg-amber-500' }}"></span>
                        {{ $appointment->deposit_receipt ? 'Resit Dimuat Naik' : 'Belum Dibayar' }}
                    </span>
                </div>
                @if($appointment->practitioner)
                    <div class="col-span-2">
                        <span class="text-neutral-500 block">Pakar Pilihan:</span>
                        <strong class="text-neutral-900">{{ $appointment->practitioner->name }} ({{ $appointment->practitioner->title }})</strong>
                    </div>
                @endif
                <div class="col-span-2 pt-3 border-t border-neutral-100 flex justify-between items-center">
                    <div>
                        <span class="text-neutral-500 block">Deposit Pengesahan Slot:</span>
                        <strong class="text-xl font-bold text-[#2D6A4F]">RM {{ number_format($appointment->deposit_amount, 2) }}</strong>
                    </div>
                    <span class="text-xs text-neutral-400">Yuran Penuh: RM {{ number_format($appointment->total_amount, 2) }}</span>
                </div>
            </div>

            {{-- Deposit Payment & Receipt Upload Section --}}
            <div class="rounded-2xl bg-neutral-50 border border-neutral-200/90 p-5 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-[#2D6A4F] text-white flex items-center justify-center text-xs font-bold">RM</span>
                    <h3 class="text-sm font-bold text-neutral-900">Maklumat Pembayaran Deposit & Resit</h3>
                </div>

                <div class="bg-white p-4 rounded-xl border border-neutral-200 text-xs space-y-1.5">
                    <div class="flex justify-between"><span class="text-neutral-500">Bank:</span> <strong class="text-neutral-800">Maybank Islamic</strong></div>
                    <div class="flex justify-between"><span class="text-neutral-500">Nama Akaun:</span> <strong class="text-neutral-800">Sakeenah Medicare Sdn Bhd</strong></div>
                    <div class="flex justify-between items-center">
                        <span class="text-neutral-500">No. Akaun:</span>
                        <span class="font-mono font-bold text-neutral-900 text-sm">5621 0678 9012</span>
                    </div>
                    <div class="flex justify-between"><span class="text-neutral-500">Rujukan Bayaran:</span> <strong class="font-mono text-[#2D6A4F]">{{ $appointment->booking_code }}</strong></div>
                </div>

                @if($appointment->deposit_receipt)
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2 text-emerald-800 font-medium">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Resit pembayaran telah diterima. Pentadbir kami sedang membuat semakan.</span>
                        </div>
                        <a href="{{ Storage::url($appointment->deposit_receipt) }}" target="_blank" class="text-xs font-bold text-emerald-700 underline hover:text-emerald-900">Lihat Resit</a>
                    </div>
                @else
                    <form action="{{ route('booking.upload-receipt', $appointment->booking_code) }}" method="POST" enctype="multipart/form-data" class="space-y-3 pt-1">
                        @csrf
                        <label class="block text-xs font-bold text-neutral-700">Muat Naik Resit Pemindahan Bank (JPG, PNG, PDF - Maks 5MB):</label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="file" name="receipt" required accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs text-neutral-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2D6A4F] file:text-white hover:file:bg-[#24543F] file:cursor-pointer border border-neutral-300 rounded-xl bg-white p-1">
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#24543F] text-white text-xs font-bold whitespace-nowrap shadow-xs transition">
                                Muat Naik Resit
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="rounded-2xl bg-emerald-50/60 border border-emerald-200/80 p-4 text-xs text-neutral-600 leading-relaxed">
                <strong class="text-[#2D6A4F] block mb-1">Peringatan Mesra:</strong>
                Salinan butiran tempahan ini turut telah dihantar ke emel <span class="font-bold text-neutral-800">{{ $appointment->client_email }}</span>. Sila semak peti masuk atau folder spam anda.
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-3">
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
