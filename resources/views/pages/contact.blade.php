@extends('layouts.public')

@section('title', 'Hubungi Kami | Sakeenah Medicare Cyberjaya')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-[#2D6A4F] text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#2D6A4F]"></span>
            Perkhidmatan Khidmat Pelanggan
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Hubungi Sakeenah Medicare</h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-2.5 leading-relaxed">
            Kunjungi klinik kami di Shaftsbury Square Cyberjaya atau hubungi pasukan kami untuk sebarang pertanyaan berkenaan sesi konsultasi, terapi, atau sebut harga program korporat.
        </p>
    </div>
</div>

<div class="py-12 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            {{-- Contact Information Cards --}}
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-neutral-900 mb-2">Maklumat Lokasi & Hubungan</h2>
                    <p class="text-xs sm:text-sm text-neutral-500 mb-6">Pintu klinik kami sentiasa terbuka untuk menyambut anda dalam suasana yang mesra dan tenang.</p>
                    
                    <div class="space-y-4 text-xs sm:text-sm text-neutral-600">
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-[#FBFBFB] border border-neutral-200/80">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100/70 text-[#2D6A4F] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <strong class="block text-neutral-900 font-semibold mb-0.5">Alamat Premis Klinik:</strong>
                                <span class="leading-relaxed">P3-03, Shaftsbury Square, Persiaran Multimedia, Cyber 6, 63000 Cyberjaya, Selangor, Malaysia</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-[#FBFBFB] border border-neutral-200/80">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100/70 text-[#2D6A4F] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <strong class="block text-neutral-900 font-semibold mb-0.5">Telefon / WhatsApp:</strong>
                                <a href="https://wa.me/601170352636" target="_blank" rel="noopener noreferrer" class="text-emerald-700 font-bold hover:underline">+60 11-7035 2636</a>
                                <span class="block text-[11px] text-neutral-400 mt-0.5">(Tersedia semasa waktu operasi)</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-[#FBFBFB] border border-neutral-200/80">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100/70 text-[#2D6A4F] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <strong class="block text-neutral-900 font-semibold mb-0.5">Alamat Emel:</strong>
                                <span class="text-neutral-700 font-mono">sakeenahmedicare@gmail.com</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-[#FBFBFB] border border-neutral-200/80">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100/70 text-[#2D6A4F] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <strong class="block text-neutral-900 font-semibold mb-0.5">Waktu Konsultasi & Operasi:</strong>
                                <span class="block text-neutral-700">Isnin – Sabtu: 9:00 AM – 9:00 PM</span>
                                <span class="block text-[11px] text-amber-700 mt-0.5">Hanya melalui temu janji berdaftar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Inquiry Form --}}
            <div class="lg:col-span-7 bg-[#FBFBFB] p-6 sm:p-10 rounded-3xl border border-neutral-200/90 shadow-sm">
                <h3 class="text-xl font-bold text-neutral-900 mb-1">Hantar Mesej Pertanyaan</h3>
                <p class="text-xs text-neutral-500 mb-6">Sila isikan borang di bawah dan pihak pengurusan klinik akan membalas pertanyaan anda secepat mungkin.</p>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Terima kasih! Pertanyaan anda telah dihantar kepada pihak klinik Sakeenah Medicare.');" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Nama Penuh: <span class="text-rose-500">*</span></label>
                            <input type="text" required placeholder="cth: Siti Sarah" class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Nombor Telefon (WhatsApp): <span class="text-rose-500">*</span></label>
                            <input type="tel" required placeholder="cth: 013-9876543" class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Alamat Emel: <span class="text-rose-500">*</span></label>
                        <input type="email" required placeholder="cth: sarah@gmail.com" class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Kategori Pertanyaan:</label>
                        <div class="relative">
                            <select class="w-full py-3.5 pl-4 pr-10 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] appearance-none transition">
                                <option>Pertanyaan Sesi Psikoterapi / Kaunseling</option>
                                <option>Penilaian Kanak-Kanak (ADHD / Spektrum Autisme)</option>
                                <option>Terapi Pertuturan & Carakerja (Speech & OT)</option>
                                <option>Sebut Harga Program Korporat (EAP) / Bengkel</option>
                                <option>Pertanyaan Am & Lain-lain</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-neutral-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-2">Mesej Anda: <span class="text-rose-500">*</span></label>
                        <textarea rows="4" required placeholder="Tuliskan soalan atau butiran pertanyaan anda di sini..." class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-full font-bold text-sm text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow transition">
                        Hantar Mesej Pertanyaan
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
