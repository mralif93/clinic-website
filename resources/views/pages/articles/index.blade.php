@extends('layouts.public')

@section('title', 'Hab Artikel & Edukasi Kesihatan Mental | Sakeenah Medicare')

@section('content')
{{-- Header Banner --}}
<div class="py-12 sm:py-16 bg-gradient-to-b from-[#F4F1EA] via-[#F4F1EA]/60 to-[#FBFBFB] border-b border-neutral-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-[#2D6A4F] text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#2D6A4F]"></span>
            Hab Psikoedukasi
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-neutral-900 tracking-tight">Artikel & Panduan Kesejahteraan Minda</h1>
        <p class="text-xs sm:text-sm text-neutral-600 mt-2.5 leading-relaxed">
            Perkongsian ilmu daripada ahli psikologi klinikal dan kaunselor berdaftar Sakeenah Medicare untuk memahami emosi, hubungan dan pemulihan diri.
        </p>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('articles.index') }}" class="mt-6 max-w-lg mx-auto flex items-center gap-2">
            @if(request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <div class="relative flex-1">
                <input type="text" 
                       name="carian" 
                       value="{{ request('carian') }}" 
                       placeholder="Cari topik kesihatan mental, stres, autisme..." 
                       class="w-full py-3 pl-10 pr-4 rounded-full border border-neutral-300 bg-white text-xs sm:text-sm shadow-xs focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
            <button type="submit" class="px-5 py-3 rounded-full bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs">
                Cari
            </button>
        </form>
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-28 sm:pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        {{-- Category Pills --}}
        <div class="flex items-center justify-center flex-wrap gap-2 pb-2">
            <a href="{{ route('articles.index') }}" 
               class="px-4 py-2 rounded-full text-xs font-bold transition {{ empty($currentCategory) ? 'bg-[#2D6A4F] text-white' : 'bg-neutral-100 text-neutral-600 hover:bg-neutral-200' }}">
                Semua Topik
            </a>
            @foreach($categories as $key => $label)
                <a href="{{ route('articles.index', ['kategori' => $key, 'carian' => request('carian')]) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition {{ $currentCategory === $key ? 'bg-[#2D6A4F] text-white' : 'bg-neutral-100 text-neutral-600 hover:bg-neutral-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Featured Article Highlight (If on Page 1 without search) --}}
        @if($featuredArticle && !request('carian') && !request('kategori') && $articles->currentPage() === 1)
            <div class="rounded-3xl border border-neutral-200/90 bg-gradient-to-br from-[#F4F1EA]/60 to-white p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center shadow-xs">
                <div class="lg:col-span-6 h-64 sm:h-80 rounded-2xl overflow-hidden bg-neutral-100">
                    <img src="{{ asset($featuredArticle->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" alt="{{ $featuredArticle->title }}" class="w-full h-full object-cover">
                </div>
                <div class="lg:col-span-6 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#2D6A4F] text-white uppercase">Pilihan Utama (Featured)</span>
                        <span class="text-xs text-neutral-400">• {{ $featuredArticle->read_time_minutes }} minit bacaan</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-neutral-900 leading-tight">
                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="hover:text-[#2D6A4F] transition">
                            {{ $featuredArticle->title }}
                        </a>
                    </h2>
                    <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed">
                        {{ $featuredArticle->summary }}
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] transition">
                            <span>Baca Sekarang</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- Grid of Articles --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <article class="rounded-3xl border border-neutral-200/80 bg-white overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="h-52 overflow-hidden bg-neutral-100 relative">
                            <img src="{{ asset($article->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3.5 left-3.5">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-white/95 text-[#2D6A4F] shadow-xs tracking-wide">
                                    {{ $categories[$article->category] ?? ucfirst($article->category) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-neutral-400 mb-2.5">
                                <span class="font-medium text-neutral-500">{{ $article->author_name }}</span>
                                <span>•</span>
                                <span>{{ $article->read_time_minutes }} minit bacaan</span>
                            </div>

                            <h3 class="text-lg font-bold text-neutral-900 group-hover:text-[#2D6A4F] transition-colors line-clamp-2 leading-snug mb-3 tracking-tight">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-[13px] text-neutral-600 line-clamp-3 leading-relaxed font-normal">
                                {{ $article->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-neutral-100 flex items-center justify-between bg-neutral-50/40">
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] group-hover:text-[#1E4634] transition">
                            <span>Baca Artikel</span>
                            <span class="text-sm font-semibold transition-transform group-hover:translate-x-1 duration-200">&rarr;</span>
                        </a>
                        <div class="inline-flex items-center gap-1 text-xs text-neutral-400">
                            <svg class="w-3.5 h-3.5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>{{ number_format($article->views_count) }} tontonan</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 py-16 text-center text-neutral-400">
                    <p class="text-sm">Tiada artikel dijumpai untuk carian atau kategori ini.</p>
                    <a href="{{ route('articles.index') }}" class="inline-block mt-3 text-xs font-bold text-[#2D6A4F] hover:underline">
                        Lihat Semua Artikel
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>

    </div>
</div>
@endsection
