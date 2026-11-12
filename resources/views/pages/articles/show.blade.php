@extends('layouts.public')

@section('title', $article->title . ' | Sakeenah Medicare')

@section('content')
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] hover:underline mb-4">
            &larr; Kembali ke Hab Artikel
        </a>
        <div class="flex items-center gap-2 mb-3">
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-[#2D6A4F] uppercase">
                {{ $article->category === 'relationship' ? 'Hubungan & Pasangan' : 'Kesihatan Mental' }}
            </span>
            <span class="text-xs text-neutral-400">• {{ $article->read_time_minutes }} minit bacaan</span>
            <span class="text-xs text-neutral-400">• {{ number_format($article->views_count) }} tontonan</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-neutral-900 tracking-tight leading-tight">
            {{ $article->title }}
        </h1>
        <div class="mt-4 flex items-center gap-3 text-xs text-neutral-500">
            <span>Oleh: <strong class="text-neutral-800">{{ $article->author_name }}</strong></span>
            <span>•</span>
            <span>Diterbitkan: {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
        </div>
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-28 sm:pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        @if($article->image_path)
            <div class="rounded-3xl overflow-hidden shadow-sm max-h-96 w-full bg-neutral-100">
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="text-neutral-700 leading-relaxed space-y-6 text-sm sm:text-base font-normal">
            <p class="text-base sm:text-lg font-medium text-neutral-800 leading-relaxed border-l-4 border-[#2D6A4F] pl-4 italic bg-neutral-50 py-3 rounded-r-2xl">
                {{ $article->summary }}
            </p>

            <div class="space-y-4 pt-2">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>

        {{-- Tags Display --}}
        @if(!empty($article->tags) && is_array($article->tags))
            <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-neutral-400 uppercase tracking-wider mr-1">Kata Kunci:</span>
                @foreach($article->tags as $t)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 text-neutral-600 hover:bg-neutral-200 transition">
                        #{{ $t }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- CTA Consultation Banner --}}
        <div class="rounded-3xl bg-gradient-to-r from-[#2D6A4F] to-[#1E4634] p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-md">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold">Perlukan Bimbingan Terapi Berkenaan Isu Ini?</h3>
                <p class="text-xs text-emerald-100">Pakar psikologi dan kaunselor kami sedia membantu anda dalam sesi peribadi yang sulit.</p>
            </div>
            <a href="{{ route('booking.index') }}" class="px-6 py-3 rounded-full text-xs font-bold text-[#2D6A4F] bg-white hover:bg-neutral-100 transition whitespace-nowrap shadow">
                Tempah Sesi Temu Janji
            </a>
        </div>

        {{-- Related Articles Section --}}
        @if($relatedArticles->isNotEmpty())
            <div class="pt-8 border-t border-neutral-100 space-y-6">
                <h3 class="text-xl font-bold text-neutral-900">Artikel Berkaitan Lain</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $rel)
                        <a href="{{ route('articles.show', $rel->slug) }}" class="group block p-4 rounded-2xl border border-neutral-200/80 bg-neutral-50 hover:bg-white hover:shadow-md transition">
                            <span class="text-[10px] font-bold text-emerald-700 uppercase block mb-1">
                                {{ ucfirst($rel->category) }}
                            </span>
                            <h4 class="text-sm font-bold text-neutral-900 group-hover:text-[#2D6A4F] transition line-clamp-2 leading-snug">
                                {{ $rel->title }}
                            </h4>
                            <span class="text-[11px] text-neutral-400 mt-2 block">{{ $rel->read_time_minutes }} minit bacaan</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
