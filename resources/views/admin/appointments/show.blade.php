@extends('layouts.admin')

@section('title', 'Perincian Tempahan ' . $appointment->booking_code . ' | Sakeenah Medicare')
@section('page_title', 'Perincian Tempahan: ' . $appointment->booking_code)

@section('admin_content')
<div class="space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1">
            &larr; Kembali ke Senarai Tempahan
        </a>
        <span class="text-xs text-neutral-400">Didaftarkan pada: {{ $appointment->created_at->format('d M Y, h:i A') }}</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Client Details --}}
        <div class="md:col-span-2 bg-white rounded-3xl border border-neutral-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h3 class="text-base font-bold text-neutral-900 border-b border-neutral-100 pb-3">Maklumat Klien & Sesi</h3>

            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-neutral-400 block mb-0.5">Nama Penuh:</span>
                    <strong class="text-sm text-neutral-900 block">{{ $appointment->client_name }}</strong>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">Umur:</span>
                    <strong class="text-sm text-neutral-900 block">{{ $appointment->client_age ?? 'Tidak dinyatakan' }} tahun</strong>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">No. Telefon (WhatsApp):</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $appointment->client_phone) }}" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline block">
                        {{ $appointment->client_phone }} &rarr;
                    </a>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">Alamat Emel:</span>
                    <strong class="text-sm text-neutral-900 block">{{ $appointment->client_email }}</strong>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 space-y-3 text-xs">
                <div>
                    <span class="text-neutral-400 block mb-0.5">Jenis Rawatan:</span>
                    <strong class="text-sm text-neutral-900 block">{{ $appointment->service->name }}</strong>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">Pakar Ditugaskan:</span>
                    <strong class="text-sm text-[#2D6A4F] block">{{ $appointment->practitioner->name ?? 'Belum Ditetapkan' }}</strong>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-neutral-400 block mb-0.5">Tarikh Sesi:</span>
                        <strong class="text-sm text-neutral-900 block">{{ $appointment->appointment_date->format('d M Y') }}</strong>
                    </div>
                    <div>
                        <span class="text-neutral-400 block mb-0.5">Waktu:</span>
                        <strong class="text-sm text-neutral-900 block">{{ $appointment->appointment_time }}</strong>
                    </div>
                </div>
                <div>
                    <span class="text-neutral-400 block mb-0.5">Mod Sesi:</span>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $appointment->session_mode === 'in_person' ? 'bg-emerald-50 text-emerald-800' : 'bg-sky-50 text-sky-800' }}">
                        {{ $appointment->session_mode === 'in_person' ? 'Bersemuka di Cyberjaya' : 'Tele-Terapi (Panggilan Video)' }}
                    </span>
                </div>
            </div>

            {{-- Bukti Resit Deposit --}}
            <div class="pt-4 border-t border-neutral-100">
                <span class="text-neutral-400 block text-xs mb-2">Bukti Pembayaran Deposit Klien:</span>
                @if($appointment->deposit_receipt)
                    <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-neutral-900">Fail Resit Telah Dimuat Naik</p>
                                <p class="text-[11px] text-neutral-500">Klik untuk menyemak bukti transaksi pembayaran deposit</p>
                            </div>
                        </div>
                        <a href="{{ Storage::url($appointment->deposit_receipt) }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#2D6A4F] text-white text-xs font-bold hover:bg-[#24543F] shadow-xs transition">
                            Buka / Muat Turun Resit &rarr;
                        </a>
                    </div>
                @else
                    <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200/80 text-xs text-amber-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>Klien belum memuat naik resit deposit melalui portal.</span>
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-neutral-100">
                <span class="text-neutral-400 block text-xs mb-1">Catatan Isu / Sebab Temu Janji Klien:</span>
                <div class="p-4 rounded-2xl bg-neutral-50 text-xs text-neutral-700 leading-relaxed border border-neutral-200/80">
                    {{ $appointment->reason_for_visit ?: 'Tiada sebarang catatan awal diberikan oleh klien.' }}
                </div>
            </div>
        </div>

        {{-- Status Update Action Card --}}
        <div class="space-y-6">
            
            {{-- Quick WhatsApp Confirmation Card --}}
            <div class="bg-gradient-to-br from-emerald-900 to-emerald-950 rounded-3xl p-6 text-white shadow-xs space-y-3">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Hubungi Pantas Klien</span>
                </div>
                <h4 class="text-sm font-bold">Mesej WhatsApp Automatik</h4>
                <p class="text-[11px] text-emerald-200/80 leading-relaxed">
                    Hantar mesej pengesahan rasmi kepada {{ $appointment->client_name }} dengan butiran sesi lengkap.
                </p>
                @php
                    $cleanPhone = preg_replace('/[^0-9]/', '', $appointment->client_phone);
                    if (str_starts_with($cleanPhone, '0')) {
                        $cleanPhone = '60' . substr($cleanPhone, 1);
                    }
                    $modeLabel = $appointment->session_mode === 'in_person' ? 'Fizikal di Sakeenah Medicare, Cyberjaya' : 'Dalam Talian (Tele-Terapi)';
                    $waText = "Salam sejahtera " . $appointment->client_name . ",\n\nIni adalah pengesahan sesi temu janji terapi anda di Sakeenah Medicare:\n" .
                              "• Kod Tempahan: " . $appointment->booking_code . "\n" .
                              "• Perkhidmatan: " . $appointment->service->name . "\n" .
                              "• Tarikh: " . $appointment->appointment_date->format('d/m/Y') . "\n" .
                              "• Masa: " . $appointment->appointment_time . "\n" .
                              "• Mod: " . $modeLabel . "\n" .
                              "• Status: " . ucfirst($appointment->status) . "\n\n" .
                              "Sebarang pertanyaan atau pertukaran jadual, sila maklumkan kepada pihak klinik. Terima kasih.";
                @endphp
                <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode($waText) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white hover:bg-emerald-50 text-emerald-900 font-bold text-xs shadow-xs transition">
                    <svg class="w-4 h-4 fill-current text-emerald-700" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2z"/></svg>
                    <span>Kirim WhatsApp Pengesahan</span>
                </a>
            </div>

            {{-- Form Status Update --}}
            <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 space-y-5 shadow-2xs">
                <h3 class="text-sm font-bold text-neutral-900 border-b border-neutral-100 pb-3">Tindakan & Pengesahan</h3>

                <form action="{{ route('admin.appointments.update-status', $appointment->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Status Tempahan:</label>
                        <select name="status" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed (Disahkan)</option>
                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Status Bayaran Deposit:</label>
                        <select name="payment_status" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            <option value="pending" {{ $appointment->payment_status === 'pending' ? 'selected' : '' }}>Pending (RM {{ number_format($appointment->deposit_amount, 2) }})</option>
                            <option value="paid" {{ $appointment->payment_status === 'paid' ? 'selected' : '' }}>Paid (Telah Dibayar)</option>
                            <option value="refunded" {{ $appointment->payment_status === 'refunded' ? 'selected' : '' }}>Refunded (Dipulangkan)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Pautan Mesyuarat (Tele-terapi):</label>
                        <input type="url" name="meeting_url" value="{{ old('meeting_url', $appointment->meeting_url) }}" placeholder="https://meet.google.com/..." class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Nota Staf / Resit:</label>
                        <textarea name="admin_notes" rows="3" placeholder="Catatan dalaman staf..." class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-xs transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>
@endsection

