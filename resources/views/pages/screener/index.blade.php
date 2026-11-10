@extends('layouts.public')

@section('title', 'Ujian Saringan Minda DASS-21 Percuma | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100/90 text-[#2D6A4F] text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5 border border-emerald-200/80">
            <span class="w-1.5 h-1.5 rounded-full bg-[#2D6A4F]"></span>
            Saringan Kendiri Minda (Sulit & Percuma)
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Ujian Saringan DASS-21</h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-2.5 leading-relaxed">
            Skala Kemurungan, Kebimbangan dan Stres (DASS-21) membantu anda mengenalpasti status kesihatan mental anda dalam tempoh 1 minggu yang lalu dengan cepat dan tepat.
        </p>
    </div>
</div>

<div class="py-10 sm:py-16 bg-[#FBFBFB] pb-28 sm:pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Panduan Skala --}}
        <div class="rounded-3xl border border-neutral-200/80 bg-white p-5 sm:p-6 mb-8 shadow-xs">
            <h2 class="font-bold text-neutral-900 text-sm mb-1.5 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#2D6A4F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Panduan Pilihan Jawapan:
            </h2>
            <p class="text-xs text-neutral-600 leading-relaxed mb-3">
                Sila baca setiap pernyataan dan tandakan nombor mengikut keadaan sebenar yang anda alami <strong>sepanjang 1 minggu yang lalu</strong>:
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                <div class="p-2.5 bg-neutral-50 rounded-xl border border-neutral-200/80 text-center">
                    <span class="font-bold text-neutral-900 block text-sm">0</span>
                    <span class="text-neutral-500 text-[11px]">Tidak pernah langsung</span>
                </div>
                <div class="p-2.5 bg-neutral-50 rounded-xl border border-neutral-200/80 text-center">
                    <span class="font-bold text-neutral-900 block text-sm">1</span>
                    <span class="text-neutral-500 text-[11px]">Kadang-kadang / Jarang</span>
                </div>
                <div class="p-2.5 bg-neutral-50 rounded-xl border border-neutral-200/80 text-center">
                    <span class="font-bold text-neutral-900 block text-sm">2</span>
                    <span class="text-neutral-500 text-[11px]">Kerap / Agak banyak</span>
                </div>
                <div class="p-2.5 bg-neutral-50 rounded-xl border border-neutral-200/80 text-center">
                    <span class="font-bold text-neutral-900 block text-sm">3</span>
                    <span class="text-neutral-500 text-[11px]">Sangat kerap / Sentiasa</span>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                Sila pastikan anda menjawab kesemua 21 soalan di bawah sebelum menghantar.
            </div>
        @endif

        {{-- Form Soalan DASS-21 --}}
        <form action="{{ route('screener.store') }}" method="POST" class="space-y-4">
            @csrf

            @foreach($questions as $id => $item)
                <div class="p-5 sm:p-6 rounded-2xl border border-neutral-200/90 bg-white hover:border-[#2D6A4F]/60 transition-all shadow-xs">
                    <p class="text-xs sm:text-sm font-semibold text-neutral-900 mb-3.5 leading-relaxed">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-[#2D6A4F] font-bold text-xs mr-2">{{ $id }}</span>
                        {{ $item['text'] }}
                    </p>

                    <div class="grid grid-cols-4 gap-2 sm:gap-3">
                        @for($score = 0; $score <= 3; $score++)
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="q[{{ $id }}]" 
                                       value="{{ $score }}" 
                                       required
                                       {{ (string)old("q.{$id}") === (string)$score ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="py-2.5 px-2 rounded-xl border border-neutral-200 text-center text-xs font-bold text-neutral-700 peer-checked:bg-[#2D6A4F] peer-checked:text-white peer-checked:border-[#2D6A4F] hover:bg-emerald-50/60 transition shadow-2xs">
                                    {{ $score }}
                                </div>
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            {{-- Optional Contact Details --}}
            <div class="p-6 rounded-3xl border border-neutral-200/90 bg-white space-y-4 mt-8 shadow-xs">
                <h3 class="text-sm font-bold text-neutral-900">Maklumat Peribadi (Pilihan)</h3>
                <p class="text-xs text-neutral-500">Isikan jika anda ingin menerima salinan analisis keputusan melalui WhatsApp/Emel.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase mb-1">Nama Panggilan:</label>
                        <input type="text" name="client_name" value="{{ old('client_name') }}" placeholder="cth: Alif" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase mb-1">No. WhatsApp:</label>
                        <input type="tel" name="client_phone" value="{{ old('client_phone') }}" placeholder="cth: 012-3456789" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase mb-1">Alamat Emel:</label>
                        <input type="email" name="client_email" value="{{ old('client_email') }}" placeholder="cth: alif@email.com" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white">
                    </div>
                </div>
            </div>

            {{-- Submit Action --}}
            <div class="pt-6 text-center">
                <button type="submit" 
                        class="w-full sm:w-auto px-10 py-4 rounded-full text-sm sm:text-base font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 mx-auto">
                    <span>Hantar & Kira Keputusan Analisis</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
