@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini Post' : 'Tulis Post Baharu') . ' | Sakeenah Medicare')
@section('page_title', $isEdit ? 'Kemaskini Artikel: ' . $article->title : 'Cipta Post / Artikel Baharu')

@section('admin_content')
<div class="space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1.5 transition">
            &larr; Kembali ke Senarai Artikel
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <strong class="font-bold block mb-1">Terdapat ralat semasa memproses borang:</strong>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $isEdit ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}" 
          method="POST" 
          class="space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- 2-Column Responsive Layout Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- Column 1: Main Article Content (8 cols) --}}
            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Kandungan Utama Artikel</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Tajuk, ringkasan dan esei penuh psikoedukasi.</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Tajuk Artikel / Post: <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               value="{{ old('title', $article->title) }}" 
                               required 
                               placeholder="cth: Cara Mengatasi Keresahan di Tempat Kerja" 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Ringkasan Eksekutif (Excerpt):
                        </label>
                        <textarea name="summary" 
                                  rows="2" 
                                  placeholder="Ringkasan 1-2 ayat yang akan dipaparkan pada kad artikel..." 
                                  class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F] leading-relaxed">{{ old('summary', $article->summary) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Kandungan Penuh Artikel: <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="content" 
                                  rows="12" 
                                  required 
                                  placeholder="Tuliskan isi penuh artikel di sini..." 
                                  class="w-full py-3 px-3.5 rounded-xl border border-neutral-300 text-xs sm:text-sm leading-relaxed font-sans bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('content', $article->content) }}</textarea>
                    </div>
                </div>

            </div>

            {{-- Column 2: Meta, Author, Settings (4 cols) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Card: Maklumat Terbitan & Penulis --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-4">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Tetapan Terbitan</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Penulis, kategori & masa bacaan.</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Kategori Artikel: <span class="text-rose-500">*</span>
                        </label>
                        <select name="category" class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            <option value="mental_health" {{ old('category', $article->category) === 'mental_health' ? 'selected' : '' }}>Kesihatan Mental</option>
                            <option value="relationship" {{ old('category', $article->category) === 'relationship' ? 'selected' : '' }}>Hubungan & Pasangan</option>
                            <option value="parenting" {{ old('category', $article->category) === 'parenting' ? 'selected' : '' }}>Keibubapaan & Anak</option>
                            <option value="depression" {{ old('category', $article->category) === 'depression' ? 'selected' : '' }}>Kemurungan & Stres</option>
                            <option value="wellness" {{ old('category', $article->category) === 'wellness' ? 'selected' : '' }}>Kesejahteraan Diri</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Nama Penulis / Pakar: <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="author_name" 
                               value="{{ old('author_name', $article->author_name ?: 'Pakar Sakeenah Medicare') }}" 
                               required 
                               placeholder="cth: CP Tasha" 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Masa Bacaan (Minit):
                        </label>
                        <input type="number" 
                               name="read_time_minutes" 
                               value="{{ old('read_time_minutes', $article->read_time_minutes ?: 4) }}" 
                               min="1" 
                               max="60" 
                               required 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Laluan Imej (Asset Path):
                        </label>
                        <input type="text" 
                               name="image_path" 
                               value="{{ old('image_path', $article->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" 
                               placeholder="media/..." 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                            Kata Kunci (Tags):
                        </label>
                        @php
                            $tagStr = is_array($article->tags) ? implode(', ', $article->tags) : '';
                        @endphp
                        <input type="text" 
                               name="tags" 
                               value="{{ old('tags', $tagStr) }}" 
                               placeholder="anxiety, stress, cbt" 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div class="space-y-2.5 pt-2 border-t border-neutral-100">
                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Terbitkan Secara Terus</span>
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Post Utama (Featured)</span>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 border-t border-neutral-100 space-y-2">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs text-center">
                            {{ $isEdit ? 'Kemaskini Artikel' : 'Simpan & Terbitkan' }}
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="w-full py-2.5 px-4 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 transition block text-center">
                            Batal
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
@endsection
