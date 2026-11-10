@extends('layouts.public')

@section('title', 'Tempah Sesi Temu Janji | Sakeenah Medicare Cyberjaya')

@section('content')
{{-- Header Banner --}}
<div class="relative py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl relative z-10">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100/90 text-[#2D6A4F] text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-3 border border-emerald-200/80">
            <span class="w-1.5 h-1.5 rounded-full bg-[#2D6A4F]"></span>
            Tempahan Slot Mudah & Pantas
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Tempah Sesi Temu Janji</h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-2.5 leading-relaxed">
            Pilih perkhidmatan, pakar pilihan anda, dan tarikh slot yang bersesuaian. Sesi boleh dijalankan secara bersemuka di Cyberjaya atau secara dalam talian (*Tele-Terapi*).
        </p>
    </div>
</div>

<div class="py-10 sm:py-16 bg-[#FBFBFB] pb-28 sm:pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Validation Errors Display --}}
        @if ($errors->any())
            <div class="mb-8 p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm shadow-sm">
                <div class="flex items-center gap-2 mb-2 font-bold text-rose-900">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Sila semak maklumat yang diperlukan:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-rose-700 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Booking Form --}}
        <form action="{{ route('booking.store') }}" method="POST" class="bg-white rounded-3xl border border-neutral-200/80 p-6 sm:p-10 shadow-sm space-y-10">
            @csrf

            {{-- ============================================== --}}
            {{-- SEKSYEN 1: MOD & PERKHIDMATAN --}}
            {{-- ============================================== --}}
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-[#2D6A4F] text-white flex items-center justify-center font-bold text-xs sm:text-sm shrink-0 shadow-sm">1</span>
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-neutral-900">Kaedah Sesi & Pilihan Terapi</h2>
                        <p class="text-xs text-neutral-500">Pilih bagaimana anda ingin menghadiri sesi rawatan.</p>
                    </div>
                </div>

                {{-- Session Mode Picker --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">
                    <label class="relative flex items-center p-4 rounded-2xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2D6A4F] has-[:checked]:bg-emerald-50/50 border-neutral-200 hover:border-neutral-300">
                        <input type="radio" name="session_mode" value="in_person" {{ old('session_mode', 'in_person') === 'in_person' ? 'checked' : '' }} class="sr-only">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-[#2D6A4F] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <span class="block font-bold text-neutral-900 text-sm">Sesi Bersemuka (Klinik)</span>
                                <span class="block text-xs text-neutral-500 mt-0.5">Shaftsbury Square, Cyberjaya</span>
                            </div>
                        </div>
                    </label>

                    <label class="relative flex items-center p-4 rounded-2xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2D6A4F] has-[:checked]:bg-emerald-50/50 border-neutral-200 hover:border-neutral-300">
                        <input type="radio" name="session_mode" value="online" {{ old('session_mode') === 'online' ? 'checked' : '' }} class="sr-only">
                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="block font-bold text-neutral-900 text-sm">Tele-Terapi (Online)</span>
                                <span class="block text-xs text-neutral-500 mt-0.5">Panggilan Video Google Meet Sulit</span>
                            </div>
                        </div>
                    </label>
                </div>

                {{-- Service Dropdown --}}
                <div class="pt-2">
                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                        Pilih Jenis Perkhidmatan / Terapi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="service_id" required class="w-full py-3.5 pl-4 pr-10 rounded-xl border border-neutral-300 bg-white text-xs sm:text-sm text-neutral-800 focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] appearance-none transition">
                            @foreach($services as $s)
                                <option value="{{ $s->id }}" {{ (string)old('service_id', request('service') === $s->slug ? $s->id : '') === (string)$s->id ? 'selected' : '' }}>
                                    {{ $s->name }} — {{ $s->price > 0 ? 'RM ' . number_format($s->price, 0) : 'Sebut Harga' }} (Deposit: RM {{ number_format($s->deposit_amount, 0) }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-neutral-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- SEKSYEN 2: PAKAR & KALENDAR SLOT --}}
            {{-- ============================================== --}}
            <div class="space-y-5 pt-8 border-t border-neutral-100">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-[#2D6A4F] text-white flex items-center justify-center font-bold text-xs sm:text-sm shrink-0 shadow-sm">2</span>
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-neutral-900">Pakar Pilihan & Tarikh Temu Janji</h2>
                        <p class="text-xs text-neutral-500">Tentukan pengamal dan waktu yang bersesuaian dengan jadual anda.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Practitioner Select --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Pakar Psikologi / Kaunselor:
                        </label>
                        <div class="relative">
                            <select name="practitioner_id" class="w-full py-3.5 pl-4 pr-10 rounded-xl border border-neutral-300 bg-white text-xs sm:text-sm text-neutral-800 focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] appearance-none transition">
                                <option value="">Mana-mana pakar yang berkelapangan</option>
                                @foreach($practitioners as $p)
                                    <option value="{{ $p->id }}" {{ (string)old('practitioner_id', request('practitioner') === $p->slug ? $p->id : '') === (string)$p->id ? 'selected' : '' }}>
                                        {{ $p->name }} ({{ $p->title }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-neutral-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Date Picker --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Cadangan Tarikh Sesi: <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" 
                               name="appointment_date" 
                               value="{{ old('appointment_date', date('Y-m-d', strtotime('+2 days'))) }}" 
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                               required 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 bg-white text-xs sm:text-sm text-neutral-800 focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>
                </div>

                {{-- Time Slot Selection --}}
                <div class="pt-2">
                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2.5">
                        Pilihan Slot Masa: <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                        @foreach(['10:00 AM', '11:30 AM', '02:00 PM', '03:30 PM', '05:00 PM', '08:00 PM'] as $time)
                            <label class="cursor-pointer">
                                <input type="radio" name="appointment_time" value="{{ $time }}" {{ old('appointment_time', '10:00 AM') === $time ? 'checked' : '' }} class="peer sr-only">
                                <div class="py-3 px-2 rounded-xl border border-neutral-200 text-xs font-bold text-neutral-700 peer-checked:bg-[#2D6A4F] peer-checked:text-white peer-checked:border-[#2D6A4F] hover:bg-emerald-50 transition text-center shadow-xs">
                                    {{ $time }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- SEKSYEN 3: MAKLUMAT KLIEN & SEBAB RUJUKAN --}}
            {{-- ============================================== --}}
            <div class="space-y-5 pt-8 border-t border-neutral-100">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-[#2D6A4F] text-white flex items-center justify-center font-bold text-xs sm:text-sm shrink-0 shadow-sm">3</span>
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-neutral-900">Maklumat Klien & Sebab Rujukan</h2>
                        <p class="text-xs text-neutral-500">Semua maklumat dilindungi sepenuhnya di bawah etika kerahsiaan perubatan.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    {{-- Client Name --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Nama Penuh Klien / Penjaga: <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="client_name" 
                               value="{{ old('client_name') }}" 
                               required 
                               placeholder="cth: Muhammad Alif" 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>

                    {{-- Client Phone / WhatsApp --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Nombor Telefon (WhatsApp): <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" 
                               name="client_phone" 
                               value="{{ old('client_phone') }}" 
                               required 
                               placeholder="cth: 012-3456789" 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>

                    {{-- Client Email --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Alamat Emel: <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" 
                               name="client_email" 
                               value="{{ old('client_email') }}" 
                               required 
                               placeholder="cth: alif@gmail.com" 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>

                    {{-- Client Age --}}
                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Umur Klien:
                        </label>
                        <input type="number" 
                               name="client_age" 
                               value="{{ old('client_age') }}" 
                               min="1" 
                               max="120" 
                               placeholder="cth: 28" 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>

                    {{-- Reason for Visit --}}
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">
                            Isu Utama / Sebab Temu Janji (Sulit):
                        </label>
                        <textarea name="reason_for_visit" 
                                  rows="3" 
                                  placeholder="Sila kongsikan serba sedikit mengenai isu, kebimbangan, atau tanda-tanda yang dialami bagi membantu pakar kami membuat persediaan awal..." 
                                  class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">{{ old('reason_for_visit') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- SUBMIT & PDPA BADGE --}}
            {{-- ============================================== --}}
            <div class="pt-6 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-xs text-neutral-500 max-w-sm">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-200/60">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <span class="leading-relaxed">Data peribadi dan rekod sesi anda dilindungi di bawah akta kerahsiaan PDPA.</span>
                </div>

                <button type="submit" 
                        class="w-full sm:w-auto px-7 py-3 rounded-full text-sm font-semibold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 shrink-0 whitespace-nowrap">
                    <span>Sahkan Tempahan Sesi</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
