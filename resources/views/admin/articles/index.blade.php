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
            <a href="{{ route('admin.articles.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-xs transition flex items-center gap-1.5 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tulis Post Baharu</span>
            </a>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200/90 shadow-2xs space-y-3">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
            <div class="flex items-center gap-2 text-neutral-800">
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Carian & Tapisan Artikel</h3>
            </div>
            <span class="text-[11px] text-neutral-400">Tapis arkib artikel mengikut tajuk, topik kategori atau status</span>
        </div>

        <form method="GET" action="{{ route('admin.articles.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 pt-0.5">
            {{-- Keyword Search --}}
            <div class="grow relative">
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari tajuk artikel, nama penulis, ringkasan..." 
                       class="w-full h-10 pl-9 pr-3.5 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition placeholder:text-neutral-400">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            {{-- Filter by Category --}}
            <div class="w-full md:w-48 relative shrink-0">
                <select name="category" class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $cat)) }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Filter by Status --}}
            <div class="w-full md:w-40 relative shrink-0">
                <select name="status" class="w-full h-10 pl-3.5 pr-8 rounded-xl border border-neutral-300 text-xs text-neutral-800 bg-[#FBFBFB] hover:border-neutral-400 focus:bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="published" {{ $selectedStatus === 'published' ? 'selected' : '' }}>Published Sahaja</option>
                    <option value="draft" {{ $selectedStatus === 'draft' ? 'selected' : '' }}>Draft Sahaja</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Submit & Reset Buttons --}}
            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" class="h-10 px-5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-xs font-bold text-white shadow-2xs transition flex items-center justify-center gap-1.5 grow md:grow-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Tapis</span>
                </button>
                @if($search || $selectedCategory || $selectedStatus)
                    <a href="{{ route('admin.articles.index') }}" class="h-10 px-3.5 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table of Articles --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-neutral-600">
                <thead class="bg-neutral-50/90 text-[10px] uppercase tracking-wider font-bold text-neutral-500 border-b border-neutral-200">
                    <tr>
                        <th class="py-3.5 px-4 min-w-[280px]">Artikel</th>
                        <th class="py-3.5 px-4 min-w-[140px]">Kategori</th>
                        <th class="py-3.5 px-4 min-w-[160px]">Penulis</th>
                        <th class="py-3.5 px-4 min-w-[90px]">Tontonan</th>
                        <th class="py-3.5 px-4 min-w-[110px]">Status</th>
                        <th class="py-3.5 px-4 min-w-[120px]">Tarikh Terbit</th>
                        <th class="py-3.5 px-4 text-right min-w-[90px]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($articles as $art)
                        <tr class="hover:bg-neutral-50/70 transition">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200 shadow-2xs">
                                        <img src="{{ asset($art->image_path ?: 'media/articles/mental-health-awareness.jpg') }}" alt="{{ $art->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="font-bold text-neutral-900 block truncate max-w-sm hover:text-[#2D6A4F] transition">
                                            {{ $art->title }}
                                        </a>
                                        <span class="text-[11px] text-neutral-400 block">{{ $art->read_time_minutes }} minit bacaan</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-neutral-100 text-neutral-700">
                                    {{ ucfirst(str_replace('_', ' ', $art->category)) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-neutral-800">
                                {{ $art->author_name }}
                            </td>
                            <td class="py-3.5 px-4 font-mono">
                                {{ number_format($art->view_count) }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($art->is_published)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-neutral-500">
                                {{ $art->published_at ? $art->published_at->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="p-1.5 rounded-lg text-neutral-500 hover:text-[#2D6A4F] hover:bg-emerald-50 transition" title="Kemaskini">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti ingin memadamkan artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-neutral-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Padam">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-neutral-400">
                                <p class="text-xs">Tiada artikel dijumpai bagi kriteria carian atau tapisan ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div class="p-4 border-t border-neutral-100">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
