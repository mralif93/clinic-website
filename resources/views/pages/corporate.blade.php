@extends('layouts.public')

@section('title', 'Program Bantuan Pekerja (EAP) & Kesejahteraan Korporat | Sakeenah Medicare')
@section('meta_description', 'Penyelesaian kesihatan mental organisasi, sesi kaunseling sulit pekerja, bengkel pengurusan stres dan kepimpinan empati di Cyberjaya.')

@section('content')
<div class="space-y-16 py-10 sm:py-16">

    {{-- Hero Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F] animate-pulse"></span>
                    <span>Employee Assistance Program (EAP) & Corporate Wellness</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-black text-neutral-900 tracking-tight leading-tight">
                    Membina Pasukan Berdaya Saing Melalui <span class="text-[#2D6A4F]">Kesihatan Mental & Emosi.</span>
                </h1>
                <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                    Pekerja yang sejahtera adalah nadi kejayaan organisasi. Sakeenah Medicare menyediakan perkhidmatan kaunseling profesional, saringan psikometrik syarikat, serta bengkel ketahanan minda bagi mengurangkan keletihan melampau (*burnout*) dan meningkatkan produktiviti pasukan anda.
                </p>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                    <a href="https://wa.me/601170352636?text=Salam%20Sakeenah%20Medicare,%20saya%20mewakili%20syarikat%20ingin%20memohon%20kertas%20cadangan%20Program%20EAP%20/%20Bengkel%20Korporat." 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="px-6 py-3.5 rounded-2xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold text-center transition shadow-xs flex items-center justify-center gap-2">
                        <span>Dapatkan Kertas Cadangan Korporat</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#modul" class="px-6 py-3.5 rounded-2xl bg-white border border-neutral-200 text-neutral-700 hover:bg-neutral-50 text-xs font-bold text-center transition shadow-2xs">
                        Lihat Modul Tawaran
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden border border-neutral-200/90 shadow-lg bg-emerald-950/5 p-2">
                    <img src="{{ asset('media/services/Walk-for-Wellness-A-Fundraiser-for-Mental-Health-Awareness.png') }}" 
                         alt="Program Kesejahteraan Korporat" 
                         class="w-full h-80 sm:h-96 object-cover rounded-2xl">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-3xl border border-neutral-200 shadow-xl max-w-xs hidden sm:block">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl font-bold">
                            🏢
                        </div>
                        <div>
                            <span class="text-xs font-bold text-neutral-900 block leading-tight">100% Sulit & Beretika</span>
                            <span class="text-[11px] text-neutral-500">Privasi pekerja dijamin di bawah Akta Kaunselor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Value Props --}}
    <section class="bg-white border-y border-neutral-200/80 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Kesan Positif Kepada Syarikat</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">Mengapa Syarikat Memilih EAP Sakeenah Medicare?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-[#FBFBFB] border border-neutral-200/90 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg font-bold">
                        📉
                    </div>
                    <h3 class="text-base font-bold text-neutral-900">Kurangkan Kehilangan Hari Bekerja</h3>
                    <p class="text-xs text-neutral-600 leading-relaxed">
                        Membantu mengurangkan kadar *absenteeism* (ketidakhadiran) dan *presenteeism* (hadir kerja tetapi tidak produktif akibat tekanan emosi).
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-[#FBFBFB] border border-neutral-200/90 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg font-bold">
                        🔒
                    </div>
                    <h3 class="text-base font-bold text-neutral-900">Sesi Kaunseling Sulit 1-ke-1</h3>
                    <p class="text-xs text-neutral-600 leading-relaxed">
                        Pekerja berasa selamat berkongsi masalah peribadi, kewangan atau keluarga tanpa risau dinilai oleh majikan atau rakan sekerja.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-[#FBFBFB] border border-neutral-200/90 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg font-bold">
                        🎯
                    </div>
                    <h3 class="text-base font-bold text-neutral-900">Kepimpinan Berempati</h3>
                    <p class="text-xs text-neutral-600 leading-relaxed">
                        Latihan khusus untuk pengurus dan pemimpin pasukan bagi mengesan tanda-tanda stres awal dan mengendalikan perbualan sensitif dengan staf.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Modul Perkhidmatan Korporat --}}
    <section id="modul" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Pakej & Fleksibiliti</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">Perkhidmatan Korporat Yang Ditawarkan</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-8 rounded-3xl bg-white border border-neutral-200/90 shadow-2xs space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-2xl">🤝</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Langganan Tahunan / Bulanan</span>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Pakej Pengekalan EAP Berstruktur</h3>
                <p class="text-xs text-neutral-600 leading-relaxed">
                    Syarikat melanggan kuota sesi terapi untuk dimanfaatkan oleh mana-mana kakitangan sepanjang tahun melalui pautan tempahan pantas klinik kami (secara dalam talian atau bersemuka di Cyberjaya).
                </p>
                <ul class="text-xs text-neutral-600 space-y-2 pt-2 border-t border-neutral-100">
                    <li class="flex items-center gap-2">✓ Laporan analitik berkala tanpa mendedahkan identiti staf</li>
                    <li class="flex items-center gap-2">✓ Akses segera kepada psikologis klinikal & kaunselor</li>
                </ul>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-neutral-200/90 shadow-2xs space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-2xl">🎤</span>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Bengkel & Seminar</span>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Bengkel Kesihatan Mental & Webinar</h3>
                <p class="text-xs text-neutral-600 leading-relaxed">
                    Sesi ceramah interaktif separuh hari atau sehari suntuk di pejabat anda atau melalui webinar maya mengenai topik-topik kritikal industri masa kini.
                </p>
                <ul class="text-xs text-neutral-600 space-y-2 pt-2 border-t border-neutral-100">
                    <li class="flex items-center gap-2">✓ Pengurusan Burnout & Keseimbangan Kerja-Kehidupan</li>
                    <li class="flex items-center gap-2">✓ Psychological Safety di Tempat Kerja</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Call to Action Card --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-900 text-white p-8 sm:p-12 rounded-3xl text-center space-y-6 shadow-xl relative overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Perlukan Rundingan Awal Bagi Pasukan Syarikat Anda?</h2>
            <p class="text-xs sm:text-sm text-neutral-300 max-w-xl mx-auto leading-relaxed">
                Hubungi konsultan korporat kami untuk berbincang mengenai bajet, keperluan modul latihan, dan penetapan saiz pakej yang bersesuaian dengan organisasi anda.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                <a href="https://wa.me/601170352636?text=Salam%20Sakeenah%20Medicare,%20saya%20ingin%20berbincang%20mengenai%20Program%20Kesejahteraan%20Korporat%20(EAP)." 
                   target="_blank"
                   rel="noopener noreferrer"
                   class="px-6 py-3.5 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-neutral-950 text-xs font-bold transition shadow-xs">
                    Hubungi Pengurus Korporat (WhatsApp)
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition">
                    Hantar Mesej Emel
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
