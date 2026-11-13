<x-mail::message>
# Salam Sejahtera, {{ $appointment->client_name }}

Terima kasih kerana memilih perkhidmatan kesihatan mental di **Sakeenah Medicare**. Permintaan tempahan slot temu janji anda telah berjaya diterima dan sedang diproses oleh pihak klinik.

<x-mail::panel>
**Kod Rujukan Tempahan:** `{{ $appointment->booking_code }}`  
**Perkhidmatan:** {{ $appointment->service->name }}  
**Mod Sesi:** {{ $appointment->session_mode === 'in_person' ? 'Bersemuka di Cyberjaya' : 'Tele-Terapi (Online)' }}  
**Tarikh & Masa:** {{ $appointment->appointment_date->format('d/m/Y') }} ({{ $appointment->appointment_time }})  
@if($appointment->practitioner)
**Pakar Pilihan:** {{ $appointment->practitioner->name }} ({{ $appointment->practitioner->title }})  
@endif
**Deposit Pengesahan Slot:** RM {{ number_format($appointment->deposit_amount, 2) }}
</x-mail::panel>

### Langkah Seterusnya
Sila pastikan anda telah menjelaskan deposit pengesahan slot bagi membolehkan pihak pentadbiran kami mengunci jadual pakar untuk sesi anda.

Anda boleh memuat naik resit bayaran deposit melalui pautan pengesahan tempahan anda di bawah:

<x-mail::button :url="route('booking.confirmation', ['booking_code' => $appointment->booking_code])">
Lihat Status & Muat Naik Resit
</x-mail::button>

Sebarang pertanyaan lanjut, anda boleh membalas emel ini atau berhubung terus dengan pasukan sokongan kami melalui WhatsApp di **+60 11-7035 2636**.

Salam santun,<br>
**Pengurusan Sakeenah Medicare**
</x-mail::message>
