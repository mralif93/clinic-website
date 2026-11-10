@extends('layouts.admin')

@section('title', 'Perincian Tempahan ' . $appointment->booking_code . ' | Sakeenah Medicare')
@section('page_title', 'Perincian Tempahan: ' . $appointment->booking_code)

@section('admin_content')
<div class="max-w-4xl space-y-6">
    
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

            <div class="pt-4 border-t border-neutral-100">
                <span class="text-neutral-400 block text-xs mb-1">Catatan Isu / Sebab Temu Janji Klien:</span>
                <div class="p-4 rounded-2xl bg-neutral-50 text-xs text-neutral-700 leading-relaxed border border-neutral-200/80">
                    {{ $appointment->reason_for_visit ?: 'Tiada sebarang catatan awal diberikan oleh klien.' }}
                </div>
            </div>
        </div>

        {{-- Status Update Action Card --}}
        <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 space-y-5 shadow-2xs h-fit">
            <h3 class="text-sm font-bold text-neutral-900 border-b border-neutral-100 pb-3">Tindakan & Pengesahan</h3>

            <form action="{{ route('admin.appointments.update-status', $appointment->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Status Tempahan:</label>
                    <select name="status" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white font-medium">
                        <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed (Disahkan)</option>
                        <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                        <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Status Bayaran Deposit:</label>
                    <select name="payment_status" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white font-medium">
                        <option value="pending" {{ $appointment->payment_status === 'pending' ? 'selected' : '' }}>Pending (RM {{ number_format($appointment->deposit_amount, 2) }})</option>
                        <option value="paid" {{ $appointment->payment_status === 'paid' ? 'selected' : '' }}>Paid (Telah Dibayar)</option>
                        <option value="refunded" {{ $appointment->payment_status === 'refunded' ? 'selected' : '' }}>Refunded (Dipulangkan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Pautan Mesyuarat (Tele-terapi):</label>
                    <input type="url" name="meeting_url" value="{{ old('meeting_url', $appointment->meeting_url) }}" placeholder="https://meet.google.com/..." class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Nota Staf / Resit:</label>
                    <textarea name="admin_notes" rows="3" placeholder="Catatan dalaman staf..." class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                </div>

                <button type="submit" class="w-full py-3 rounded-full text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>

    </div>

</div>
@endsection

