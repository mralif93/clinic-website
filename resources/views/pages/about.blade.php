@extends('layouts.public')

@section('title', 'Tentang Sakeenah Medicare | Klinik Psikologi Cyberjaya')

@section('content')
<div class="py-16 bg-[#F4F1EA]/60 border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <h1 class="text-xs font-bold uppercase tracking-widest text-[#2D6A4F] mb-3">Tentang Kami</h1>
        <h2 class="text-4xl font-extrabold text-neutral-900 tracking-tight mb-4">Sakeenah Medicare (SKMED)</h2>
        <p class="text-base text-neutral-600 leading-relaxed">
            Menyediakan ruang selamat, profesional dan penuh empati untuk membimbing setiap individu dan keluarga ke arah ketenangan dan kesejahteraan minda.
        </p>
    </div>
</div>

<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        {{-- Story & Vision --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-xs font-bold uppercase tracking-wider text-[#2D6A4F] bg-emerald-50 px-3 py-1 rounded-full">Falsafah Kami</span>
                <h3 class="text-3xl font-extrabold text-neutral-900 tracking-tight">Ketenangan (Sakeenah) Bermula Dari Penerimaan & Bimbingan Tepat</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">
                    Diasaskan dengan matlamat merapatkan jurang sokongan kesihatan mental di Malaysia, Sakeenah Medicare beroperasi di Cyberjaya bagi menawarkan penilaian diagnostik yang tepat serta psikoterapi beretika.
                </p>
                <p class="text-sm text-neutral-600 leading-relaxed">
                    Kami percaya bahawa setiap kesakitan emosi, kecelaruan pemikiran, mahupun kelewatan perkembangan anak mempunyai jalan intervensi yang boleh dipulihkan secara berperingkat dengan bimbingan pengamal berdaftar.
                </p>
                <div class="pt-4 grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200">
                        <span class="text-2xl font-black text-[#2D6A4F] block">100%</span>
                        <span class="text-xs text-neutral-600">Pengamal Berdaftar & Bertauliah</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-neutral-50 border border-neutral-200">
                        <span class="text-2xl font-black text-[#2D6A4F] block">Sulit</span>
                        <span class="text-xs text-neutral-600">Pematuhan Penuh Etika Kerahsiaan PDPA</span>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg border-4 border-white bg-neutral-100">
                <img src="{{ asset('media/services/Our-Services.png') }}" alt="Sakeenah Medicare Services" class="w-full h-auto object-cover">
            </div>
        </div>

    </div>
</div>
@endsection

