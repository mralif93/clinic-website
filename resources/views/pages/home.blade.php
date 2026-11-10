@extends('layouts.public')

@section('title', 'Sakeenah Medicare | Ruang Selamat Menuju Ketenangan Jiwa & Kesejahteraan Mental')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden pt-8 pb-16 sm:pt-12 sm:pb-20 lg:pt-20 lg:pb-28 bg-gradient-to-b from-[#F4F1EA]/70 via-[#FBFBFB] to-[#FBFBFB]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                {{-- Hero Copy --}}
                <div class="lg:col-span-7 space-y-4 sm:space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full bg-emerald-100/80 text-[#2D6A4F] text-[11px] sm:text-xs font-semibold tracking-wide border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                        Pusat Psikologi & Kesejahteraan Emosi Cyberjaya
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-neutral-900 tracking-tight leading-[1.2]">
                        Ruang selamat menuju <span class="text-[#2D6A4F] underline decoration-[#52B788]/60 underline-offset-4 sm:underline-offset-8">ketenangan</span> dan pemulihan jiwa.
                    </h1>

                    <p class="text-sm sm:text-base lg:text-lg text-neutral-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        "Healing is a journey, and every step forward matters." Kami menyediakan ruang klinikal yang empati, sulit, dan profesional untuk kanak-kanak, dewasa, pasangan, dan keluarga.
                    </p>

                    <div class="pt-2 sm:pt-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-center lg:justify-start gap-3 sm:gap-4">
                        <a href="{{ route('booking.index') }}" 
                           class="w-full sm:w-auto px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-sm sm:text-base font-bold text-white bg-[#E07A5F] hover:bg-[#CC654A] shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Tempah Sesi Temu Janji</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <a href="{{ route('screener.index') }}" 
                           class="w-full sm:w-auto px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-sm sm:text-base font-semibold text-[#2D6A4F] bg-white hover:bg-neutral-50 border border-neutral-300 shadow-sm transition flex items-center justify-center gap-2">
                            <span>Ujian Saringan Minda</span>
                            <span class="text-[10px] sm:text-xs px-2 py-0.5 rounded-md bg-amber-100 text-amber-800 font-bold">DASS-21</span>
                        </a>
                    </div>

                    {{-- Badges / Credentials --}}
                    <div class="pt-4 sm:pt-6 border-t border-neutral-200/80 flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 text-[11px] sm:text-xs text-neutral-500 font-medium">
                        <div class="flex items-center gap-1.5">
                            <span class="text-emerald-600 font-bold">✓</span> Pengamal Berdaftar (MAHPC & KBM)
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-emerald-600 font-bold">✓</span> Sesi Bersemuka & Tele-Terapi
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-emerald-600 font-bold">✓</span> Kerahsiaan Klien Terjamin (PDPA)
                        </div>
                    </div>
                </div>

                {{-- Hero Visual / Video / Card --}}
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-sm sm:max-w-md lg:max-w-none rounded-3xl overflow-hidden shadow-xl sm:shadow-2xl border-4 border-white bg-white">
                        <img src="{{ asset('media/services/Therapy-Moment_-High-Five-Connection.png') }}" 
                             alt="Therapy Moment at Sakeenah Medicare" 
                             class="w-full h-64 sm:h-80 lg:h-96 object-cover object-center">
                        
                        {{-- Floating Card --}}
                        <div class="p-4 sm:p-6 bg-white space-y-2 sm:space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">Klinik Cyberjaya</span>
                                <span class="text-[10px] sm:text-xs text-neutral-500">Shaftsbury Square</span>
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-neutral-900">Konsultasi Pakar & Kaunseling Bertauliah</h2>
                            <p class="text-xs text-neutral-600 leading-relaxed">
                                Dapatkan bimbingan psikoterapi bersama pakar psikologi klinikal dan kaunselor berlesen kami dalam suasana yang menenangkan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Interactive Category Finder --}}
    <section class="py-12 sm:py-16 bg-[#F4F1EA]/60 border-y border-neutral-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <h2 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-2">Bantuan Khusus Mengikut Keperluan</h2>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">Apakah sokongan yang anda cari hari ini?</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                {{-- Category 1 --}}
                <a href="{{ route('services.index') }}#dewasa" class="group p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-sm hover:shadow-md hover:border-[#2D6A4F] transition-all">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-[#2D6A4F] flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-[#2D6A4F] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-neutral-900 mb-1 sm:mb-2">Untuk Diri Sendiri</h4>
                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">Mengatasi keresahan berterusan, kemurungan, stres kerja, insomnia & trauma.</p>
                </a>

                {{-- Category 2 --}}
                <a href="{{ route('services.index') }}#kanak-kanak" class="group p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-sm hover:shadow-md hover:border-[#2D6A4F] transition-all">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-[#2D6A4F] flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-[#2D6A4F] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-neutral-900 mb-1 sm:mb-2">Untuk Anak & Remaja</h4>
                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">Penilaian ADHD, Spektrum Autisme, kelewatan pertuturan (Speech) & terapi cara kerja.</p>
                </a>

                {{-- Category 3 --}}
                <a href="{{ route('services.index') }}#pasangan" class="group p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-sm hover:shadow-md hover:border-[#2D6A4F] transition-all">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-[#2D6A4F] flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-[#2D6A4F] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-neutral-900 mb-1 sm:mb-2">Untuk Suami Isteri</h4>
                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">Kaunseling perkahwinan, memulihkan komunikasi, isu kecurangan & krisis perhubungan.</p>
                </a>

                {{-- Category 4 --}}
                <a href="{{ route('services.index') }}#korporat" class="group p-5 sm:p-6 rounded-2xl bg-white border border-neutral-200/80 shadow-sm hover:shadow-md hover:border-[#2D6A4F] transition-all">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-[#2D6A4F] flex items-center justify-center mb-3 sm:mb-4 group-hover:bg-[#2D6A4F] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-neutral-900 mb-1 sm:mb-2">Korporat & EAP</h4>
                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">Bengkel kesihatan mental syarikat, pengurusan stres pekerja & kaunseling sulit pekerja.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Services Section --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 sm:mb-12">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-2">Perkhidmatan Klinikal Utama</h2>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">Rawatan & Terapi Bertauliah</h3>
                </div>
                <a href="{{ route('services.index') }}" class="mt-3 md:mt-0 text-sm font-bold text-[#2D6A4F] hover:text-[#1E4634] flex items-center gap-1">
                    Lihat Semua Perkhidmatan <span>&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($featuredServices as $service)
                    <div class="rounded-2xl border border-neutral-200/80 bg-white overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <div class="h-44 sm:h-48 overflow-hidden bg-neutral-100">
                                <img src="{{ asset($service->image_path ?? 'media/services/Better-therapy-thumbnail.jpg') }}" 
                                     alt="{{ $service->name }}" 
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-5 sm:p-6">
                                <span class="text-[10px] sm:text-xs font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wider">
                                    {{ $service->target_audience }}
                                </span>
                                <h4 class="text-base sm:text-lg font-bold text-neutral-900 mt-3 mb-2 leading-snug">
                                    {{ $service->name }}
                                </h4>
                                <p class="text-xs text-neutral-600 line-clamp-3 leading-relaxed">
                                    {{ $service->summary }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6 pt-0 border-t border-neutral-100 mt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-neutral-500 block">Kadar Sesi:</span>
                                <span class="text-sm sm:text-base font-bold text-neutral-900">
                                    {{ $service->price > 0 ? 'RM ' . number_format($service->price, 0) : 'Sebut Harga' }}
                                </span>
                            </div>
                            <a href="{{ route('booking.index') }}?service={{ $service->slug }}" 
                               class="px-3.5 sm:px-4 py-2 rounded-full text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] transition">
                                Pilih Sesi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Meet Our Specialists --}}
    <section class="py-16 sm:py-20 bg-[#FBFBFB] border-t border-neutral-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-2">Pasukan Profesional Kami</h2>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 tracking-tight">Bersama Pakar Psikologi & Kaunselor Berdaftar</h3>
                <p class="text-xs sm:text-sm text-neutral-600 mt-3">Setiap pengamal kami memegang pentauliahan rasmi dan komited menyediakan sesi terapi yang bebas prejudis.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($practitioners as $p)
                    <div class="rounded-2xl bg-white border border-neutral-200/80 p-6 shadow-sm hover:shadow-md transition text-center flex flex-col justify-between items-center">
                        <div class="w-full">
                            <div class="w-28 h-28 sm:w-32 sm:h-32 mx-auto rounded-full overflow-hidden bg-neutral-100 border-4 border-emerald-50 mb-4">
                                <img src="{{ asset($p->photo_path) }}" 
                                     alt="{{ $p->name }}" 
                                     class="w-full h-full object-cover object-top">
                            </div>
                            <h4 class="text-base sm:text-lg font-bold text-neutral-900">{{ $p->name }}</h4>
                            <p class="text-xs font-semibold text-[#2D6A4F] mb-1">{{ $p->title }}</p>
                            <span class="inline-block text-[11px] text-neutral-400 font-mono mb-3">{{ $p->registration_number }}</span>
                            <p class="text-xs text-neutral-600 line-clamp-3 leading-relaxed mb-4">
                                {{ $p->bio }}
                            </p>
                        </div>

                        <div class="w-full pt-4 border-t border-neutral-100 flex items-center justify-between">
                            <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full font-medium">Slot Tersedia</span>
                            <a href="{{ route('booking.index') }}?practitioner={{ $p->slug }}" 
                               class="text-xs font-bold text-[#E07A5F] hover:text-[#CC654A] flex items-center gap-1">
                                Tempah Slot <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 sm:mt-12 text-center">
                <a href="{{ route('practitioners.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs sm:text-sm font-bold text-[#2D6A4F] bg-emerald-50 hover:bg-emerald-100 transition">
                    Lihat Profil Penuh Semua Pakar Kami <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Free Screener Teaser Banner --}}
    <section class="py-12 sm:py-16 bg-gradient-to-r from-[#2D6A4F] to-[#1E4634] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-center">
                <div class="lg:col-span-8 space-y-3 sm:space-y-4 text-center lg:text-left">
                    <span class="text-[11px] sm:text-xs font-bold uppercase tracking-widest text-emerald-300">Ujian Saringan Minda Kendiri (Percuma)</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Ketahui Tahap Stres, Kebimbangan & Kemurungan Anda (DASS-21)</h3>
                    <p class="text-emerald-100 text-xs sm:text-sm leading-relaxed max-w-2xl">
                        Ujian saringan klinikal standard yang mengambil masa kurang daripada 3 minit. Jawapan anda 100% sulit dan keputusan segera diberikan secara terus.
                    </p>
                </div>
                <div class="lg:col-span-4 flex justify-center lg:justify-end">
                    <a href="{{ route('screener.index') }}" 
                       class="w-full sm:w-auto text-center px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-sm sm:text-base font-bold text-[#2D6A4F] bg-white hover:bg-neutral-100 shadow-lg transition">
                        Mula Saringan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
