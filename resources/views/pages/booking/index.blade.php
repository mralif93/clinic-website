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
                            <select name="practitioner_id" id="practitioner_select" class="w-full py-3.5 pl-4 pr-10 rounded-xl border border-neutral-300 bg-white text-xs sm:text-sm text-neutral-800 focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] appearance-none transition">
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
                               id="appointment_date_input"
                               value="{{ old('appointment_date', date('Y-m-d', strtotime('+2 days'))) }}" 
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                               required 
                               class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 bg-white text-xs sm:text-sm text-neutral-800 focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>
                </div>

                {{-- Time Slot Selection --}}
                <div class="pt-2">
                    <div class="flex items-center justify-between mb-2.5">
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">
                            Pilihan Slot Masa: <span class="text-rose-500">*</span>
                        </label>
                        <span id="slot_checking_indicator" class="hidden text-xs text-[#2D6A4F] items-center gap-1.5 font-medium animate-pulse">
                            <svg class="w-3.5 h-3.5 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                            Menyemak ketersediaan...
                        </span>
                    </div>

                    <div id="time_slots_grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                        @foreach(['09:00 AM', '10:00 AM', '11:30 AM', '02:00 PM', '03:30 PM', '05:00 PM', '08:00 PM'] as $time)
                            <label class="cursor-pointer time-slot-label" data-time="{{ $time }}">
                                <input type="radio" name="appointment_time" value="{{ $time }}" {{ old('appointment_time', '10:00 AM') === $time ? 'checked' : '' }} class="peer sr-only">
                                <div class="slot-box py-3 px-2 rounded-xl border border-neutral-200 text-xs font-bold text-neutral-700 peer-checked:bg-[#2D6A4F] peer-checked:text-white peer-checked:border-[#2D6A4F] hover:bg-emerald-50 transition text-center shadow-xs">
                                    {{ $time }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p id="slot_notice" class="text-xs text-neutral-500 mt-2">Pilih tarikh dan masa untuk menyemak jadual terkini pakar.</p>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('appointment_date_input');
    const practitionerSelect = document.getElementById('practitioner_select');
    const indicator = document.getElementById('slot_checking_indicator');
    const notice = document.getElementById('slot_notice');
    const slotLabels = document.querySelectorAll('.time-slot-label');

    async function checkAvailability() {
        const date = dateInput ? dateInput.value : '';
        const practitionerId = practitionerSelect ? practitionerSelect.value : '';

        if (!date) return;

        if (indicator) indicator.classList.remove('hidden');

        try {
            const url = new URL('{{ route("booking.booked-slots") }}', window.location.origin);
            url.searchParams.append('date', date);
            if (practitionerId) {
                url.searchParams.append('practitioner_id', practitionerId);
            }

            const res = await fetch(url.toString(), {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (res.ok) {
                const data = await res.json();
                const booked = data.booked_slots || [];
                const allowed = data.allowed_slots || [];
                const isWorkingDay = data.is_working_day;
                const isOnLeave = data.is_on_leave;
                const grid = document.getElementById('time_slots_grid');

                if (isOnLeave) {
                    if (grid) {
                        const allLabels = grid.querySelectorAll('.time-slot-label');
                        allLabels.forEach(label => {
                            const radio = label.querySelector('input[type="radio"]');
                            const box = label.querySelector('.slot-box');
                            radio.disabled = true;
                            radio.checked = false;
                            label.classList.add('cursor-not-allowed', 'opacity-30');
                            label.classList.remove('cursor-pointer');
                            box.classList.remove('hover:bg-emerald-50');
                            box.classList.add('bg-neutral-100', 'text-neutral-400');
                        });
                    }

                    if (notice) {
                        notice.innerHTML = `<span class="text-rose-600 font-semibold flex items-center gap-1.5"><svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>Pakar ini sedang bercuti pada tarikh yang dipilih. Sila pilih tarikh lain.</span>`;
                    }
                    return;
                }

                if (!isWorkingDay) {
                    if (grid) {
                        const allLabels = grid.querySelectorAll('.time-slot-label');
                        allLabels.forEach(label => {
                            const radio = label.querySelector('input[type="radio"]');
                            const box = label.querySelector('.slot-box');
                            radio.disabled = true;
                            radio.checked = false;
                            label.classList.add('cursor-not-allowed', 'opacity-30');
                            label.classList.remove('cursor-pointer');
                            box.classList.remove('hover:bg-emerald-50');
                            box.classList.add('bg-neutral-100', 'text-neutral-400');
                        });
                    }

                    if (notice) {
                        notice.innerHTML = `<span class="text-rose-600 font-semibold flex items-center gap-1.5"><svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Pakar ini tidak bertugas pada hari berkenaan (${data.day_name}). Sila pilih tarikh lain.</span>`;
                    }
                    return;
                }

                // If specific allowed slots exist from practitioner, render dynamically
                if (allowed.length > 0 && grid) {
                    const currentSelectedTime = document.querySelector('input[name="appointment_time"]:checked')?.value;
                    grid.innerHTML = '';
                    let disabledCount = 0;

                    allowed.forEach((time, index) => {
                        const isBooked = booked.includes(time);
                        if (isBooked) disabledCount++;

                        const isChecked = currentSelectedTime ? currentSelectedTime === time : (!isBooked && index === 0);

                        const label = document.createElement('label');
                        label.className = `time-slot-label ${isBooked ? 'cursor-not-allowed opacity-40' : 'cursor-pointer'}`;
                        label.setAttribute('data-time', time);

                        label.innerHTML = `
                            <input type="radio" name="appointment_time" value="${time}" ${isChecked && !isBooked ? 'checked' : ''} ${isBooked ? 'disabled' : ''} class="peer sr-only">
                            <div class="slot-box py-3 px-2 rounded-xl border border-neutral-200 text-xs font-bold text-neutral-700 peer-checked:bg-[#2D6A4F] peer-checked:text-white peer-checked:border-[#2D6A4F] ${isBooked ? 'bg-neutral-100 line-through text-neutral-400' : 'hover:bg-emerald-50'} transition text-center shadow-xs" title="${isBooked ? 'Slot ini telah ditempah' : ''}">
                                ${time}
                            </div>
                        `;
                        grid.appendChild(label);
                    });

                    // Ensure an available radio is selected
                    const checkedRadio = grid.querySelector('input[name="appointment_time"]:checked');
                    if (!checkedRadio) {
                        const firstAvailable = grid.querySelector('input[name="appointment_time"]:not(:disabled)');
                        if (firstAvailable) {
                            firstAvailable.checked = true;
                        }
                    }

                    if (notice) {
                        if (disabledCount > 0) {
                            notice.innerHTML = `<span class="text-amber-700 font-medium">Jadual pakar: ${disabledCount} slot masa telah penuh. Sila pilih slot yang aktif.</span>`;
                        } else {
                            notice.innerHTML = `<span class="text-emerald-700 font-medium">Pakar bertugas pada hari ini. Semua ${allowed.length} slot masa dibuka untuk pilihan anda.</span>`;
                        }
                    }
                    return;
                }

                slotLabels.forEach(label => {
                    const time = label.getAttribute('data-time');
                    const radio = label.querySelector('input[type="radio"]');
                    const box = label.querySelector('.slot-box');

                    const isTimeAllowed = allowed.length === 0 || allowed.includes(time);
                    const isTimeBooked = booked.includes(time);

                    if (!isTimeAllowed || isTimeBooked) {
                        disabledCount++;
                        radio.disabled = true;
                        label.classList.add('cursor-not-allowed', 'opacity-40');
                        label.classList.remove('cursor-pointer');
                        box.classList.remove('hover:bg-emerald-50');
                        box.classList.add('bg-neutral-100', 'line-through', 'text-neutral-400', 'border-neutral-200');
                        box.title = isTimeBooked ? 'Slot ini telah ditempah' : 'Pakar tidak menyediakan slot pada waktu ini';

                        // If currently checked slot became disabled, uncheck it
                        if (radio.checked) {
                            radio.checked = false;
                        }
                    } else {
                        radio.disabled = false;
                        label.classList.remove('cursor-not-allowed', 'opacity-40', 'opacity-30');
                        label.classList.add('cursor-pointer');
                        box.classList.remove('bg-neutral-100', 'line-through', 'text-neutral-400');
                        box.classList.add('hover:bg-emerald-50');
                        box.removeAttribute('title');
                    }
                });

                // Pick first available if none is checked
                const checkedRadio = document.querySelector('input[name="appointment_time"]:checked');
                if (!checkedRadio) {
                    const firstAvailable = document.querySelector('input[name="appointment_time"]:not(:disabled)');
                    if (firstAvailable) {
                        firstAvailable.checked = true;
                    }
                }

                if (notice) {
                    if (disabledCount > 0) {
                        notice.innerHTML = `<span class="text-amber-700 font-medium">Jadual pakar dikemaskini: ${disabledCount} slot masa tidak tersedia/telah penuh. Sila pilih waktu yang aktif.</span>`;
                    } else {
                        notice.innerHTML = `<span class="text-emerald-700 font-medium">Pakar bertugas pada hari ini. Semua slot masa dibuka untuk pilihan anda.</span>`;
                    }
                }
            }
        } catch (err) {
            console.error('Ralat menyemak slot:', err);
        } finally {
            if (indicator) indicator.classList.add('hidden');
        }
    }

    if (dateInput) dateInput.addEventListener('change', checkAvailability);
    if (practitionerSelect) practitionerSelect.addEventListener('change', checkAvailability);

    // Initial check
    checkAvailability();
});
</script>
@endsection
