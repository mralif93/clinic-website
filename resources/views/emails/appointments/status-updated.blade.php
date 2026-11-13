<x-mail::message>
# Salam Sejahtera, {{ $appointment->client_name }}

Status tempahan temu janji anda di **Sakeenah Medicare** telah dikemaskini oleh pihak pentadbiran kami.

@php
    $statusText = match($appointment->status) {
        'confirmed' => 'DISAHKAN (CONFIRMED)',
        'completed' => 'SELESAI (COMPLETED)',
        'cancelled' => 'DIBATALKAN (CANCELLED)',
        default => strtoupper($appointment->status),
    };
@endphp

<x-mail::panel>
**Kod Tempahan:** `{{ $appointment->booking_code }}`  
**Status Terkini:** **{{ $statusText }}**  
**Perkhidmatan:** {{ $appointment->service->name }}  
**Tarikh & Masa:** {{ $appointment->appointment_date->format('d/m/Y') }} ({{ $appointment->appointment_time }})  
**Status Bayaran:** {{ strtoupper($appointment->payment_status) }}  
@if($appointment->practitioner)
**Pakar:** {{ $appointment->practitioner->name }}  
@endif
@if($appointment->meeting_url && $appointment->session_mode === 'online')
**Pautan Google Meet/Tele-Terapi:** [Sertai Sesi Dalam Talian]({{ $appointment->meeting_url }})  
@endif
</x-mail::panel>

@if($appointment->admin_notes)
### Nota Pentadbiran:
> {{ $appointment->admin_notes }}
@endif

<x-mail::button :url="route('booking.confirmation', ['booking_code' => $appointment->booking_code])">
Lihat Ringkasan Tempahan
</x-mail::button>

Sebarang persoalan lanjut, anda boleh menghubungi pihak kami di WhatsApp **+60 11-7035 2636**.

Terima kasih,<br>
**Pengurusan Sakeenah Medicare**
</x-mail::message>
