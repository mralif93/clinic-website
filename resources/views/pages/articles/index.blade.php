@extends('layouts.public')

@section('title', 'Hab Artikel & Edukasi Kesihatan Mental | Sakeenah Medicare')

@section('content')
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
    </div>
</div>

<div class="py-12 sm:py-16 bg-white pb-28 sm:pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <article class="rounded-3xl border border-neutral-200/80 bg-white overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="h-48 overflow-hidden bg-neutral-100 relative">
                            <img src="{{ asset($article->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/95 text-[#2D6A4F] shadow-xs uppercase">
                                    {{ $article->category === 'relationship' ? 'Hubungan & Pasangan' : 'Kesihatan Mental' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-2 text-[11px] text-neutral-400 mb-2">
                                <span>{{ $article->author_name }}</span>
                                <span>•</span>
                                <span>{{ $article->read_time_minutes }} minit bacaan</span>
                            </div>

                            <h3 class="text-lg font-bold text-neutral-900 group-hover:text-[#2D6A4F] transition-colors line-clamp-2 leading-snug mb-2">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-xs text-neutral-600 line-clamp-3 leading-relaxed">
                                {{ $article->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0 border-t border-neutral-100 mt-2">
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] hover:text-[#1E4634] transition">
                            <span>Baca Artikel Penuh</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 py-12 text-center text-neutral-400">
                    Tiada artikel diterbitkan pada masa ini.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>

    </div>
</div>
@endsection

