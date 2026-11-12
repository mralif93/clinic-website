@extends('layouts.admin')

@section('title', 'Pengurusan Artikel & Post | Sakeenah Medicare')
@section('page_title', 'Pengurusan Post & Artikel Psikoedukasi')

@section('admin_content')
<div class="space-y-6">
    
    {{-- Header & Create Action --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-neutral-900 tracking-tight">Senarai Artikel & Blog</h2>
            <p class="text-xs text-neutral-500 mt-0.5">Urus dan terbitkan kandungan kesedaran psikologi, hubungan, dan panduan terapi.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.articles.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-xs transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tulis Post Baharu</span>
            </a>
        </div>
    </div>

    {{-- Filter & Search Bar --}}
    <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-neutral-200/90 shadow-2xs flex items-center justify-between">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="flex items-center gap-2 w-full max-w-md">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari tajuk artikel atau nama penulis..." class="w-full py-2 px-3.5 rounded-xl border border-neutral-300 text-xs bg-[#FBFBFB] focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F]">
            <button type="submit" class="px-4 py-2 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-xs font-bold text-neutral-700 transition">
                Cari
            </button>
            @if(request('q'))
                <a href="{{ route('admin.articles.index') }}" class="text-xs text-rose-600 hover:underline whitespace-nowrap">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table of Articles --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50/90 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                    <tr>
                        <th class="py-3.5 px-4">Artikel</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Penulis</th>
                        <th class="py-3.5 px-4">Tontonan</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Tarikh Terbit</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($articles as $art)
                        <tr class="hover:bg-neutral-50/70 transition">
                            <td class="py-3.5 px-4 max-w-xs">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200">
                                        <img src="{{ asset($art->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="font-bold text-neutral-900 hover:text-[#2D6A4F] line-clamp-1 block">
                                            {{ $art->title }}
                                        </a>
                                        @if($art->is_featured)
                                            <span class="inline-block px-1.5 py-0.2 rounded bg-amber-100 text-amber-800 text-[9px] font-bold uppercase mt-0.5">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-neutral-100 text-neutral-700 capitalize">
                                    {{ $art->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-neutral-800">{{ $art->author_name }}</td>
                            <td class="py-3.5 px-4 font-mono">{{ number_format($art->views_count) }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $art->is_published ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-neutral-100 text-neutral-600 border-neutral-200' }} uppercase">
                                    {{ $art->is_published ? 'Diterbitkan' : 'Draf' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-[11px] text-neutral-400">
                                {{ $art->published_at ? $art->published_at->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="px-2.5 py-1 rounded-lg bg-neutral-100 hover:bg-[#2D6A4F] hover:text-white font-bold transition text-[11px]">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti ingin memadamkan artikel ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 rounded-lg hover:bg-rose-50 text-rose-600 transition text-[11px] font-bold">
                                            Padam
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-neutral-400">Tiada artikel dijumpai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-neutral-100">
            {{ $articles->links() }}
        </div>
    </div>

</div>
@endsection

