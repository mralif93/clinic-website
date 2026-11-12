@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini Post' : 'Tulis Post Baharu') . ' | Sakeenah Medicare')
@section('page_title', $isEdit ? 'Kemaskini Artikel: ' . $article->title : 'Cipta Post / Artikel Baharu')

@section('admin_content')
<div class="max-w-4xl space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1">
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
          class="bg-white rounded-3xl border border-neutral-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- Tajuk & Kategori --}}
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                    Tajuk Artikel / Post: <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $article->title) }}" 
                       required 
                       placeholder="cth: Cara Mengatasi Keresahan di Tempat Kerja" 
                       class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-sm focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                        Kategori Artikel: <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white">
                        <option value="mental_health" {{ old('category', $article->category) === 'mental_health' ? 'selected' : '' }}>Kesihatan Mental</option>
                        <option value="relationship" {{ old('category', $article->category) === 'relationship' ? 'selected' : '' }}>Hubungan & Pasangan</option>
                        <option value="parenting" {{ old('category', $article->category) === 'parenting' ? 'selected' : '' }}>Keibubapaan & Anak</option>
                        <option value="depression" {{ old('category', $article->category) === 'depression' ? 'selected' : '' }}>Kemurungan & Stres</option>
                        <option value="wellness" {{ old('category', $article->category) === 'wellness' ? 'selected' : '' }}>Kesejahteraan Diri</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                        Nama Penulis / Pakar: <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="author_name" 
                           value="{{ old('author_name', $article->author_name ?: 'Pakar Sakeenah Medicare') }}" 
                           required 
                           placeholder="cth: CP Tasha (Psikologis Klinikal)" 
                           class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm">
                </div>
            </div>
        </div>

        {{-- Imej & Masa Bacaan & Tags --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
            <div>
                <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                    Laluan Imej (Image Path):
                </label>
                <input type="text" 
                       name="image_path" 
                       value="{{ old('image_path', $article->image_path) }}" 
                       placeholder="media/services/Better-therapy-thumbnail.jpg" 
                       class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs font-mono">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                    Anggaran Masa Bacaan (Minit):
                </label>
                <input type="number" 
                       name="read_time_minutes" 
                       value="{{ old('read_time_minutes', $article->read_time_minutes ?: 4) }}" 
                       min="1" 
                       max="60" 
                       required 
                       class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                    Kata Kunci / Tag (Pisahkan koma):
                </label>
                @php
                    $tagStr = is_array($article->tags) ? implode(', ', $article->tags) : '';
                @endphp
                <input type="text" 
                       name="tags" 
                       value="{{ old('tags', $tagStr) }}" 
                       placeholder="anxiety, stress, cbt" 
                       class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs">
            </div>
        </div>

        {{-- Ringkasan (Summary) --}}
        <div>
            <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                Ringkasan Eksekutif (Excerpt / Summary):
            </label>
            <textarea name="summary" 
                      rows="2" 
                      placeholder="Ringkasan 1-2 ayat yang akan dipaparkan pada kad artikel..." 
                      class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm leading-relaxed">{{ old('summary', $article->summary) }}</textarea>
        </div>

        {{-- Kandungan Penuh (Full Content) --}}
        <div>
            <label class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                Kandungan Penuh Artikel: <span class="text-rose-500">*</span>
            </label>
            <textarea name="content" 
                      rows="10" 
                      required 
                      placeholder="Tuliskan isi penuh artikel di sini..." 
                      class="w-full py-3.5 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm leading-relaxed font-sans">{{ old('content', $article->content) }}</textarea>
        </div>

        {{-- Status Terbitan & Pilihan Utama --}}
        <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center gap-6 text-xs font-medium">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                <span class="text-neutral-800 font-semibold">Terbitkan Secara Terus (Publish Live)</span>
            </label>

            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                <span class="text-neutral-800 font-semibold">Jadikan Post Utama (Featured Post)</span>
            </label>
        </div>

        {{-- Submit Action --}}
        <div class="pt-4 border-t border-neutral-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-full text-xs font-semibold text-neutral-600 hover:bg-neutral-100 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 rounded-full text-xs font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-md transition">
                {{ $isEdit ? 'Kemaskini Artikel' : 'Simpan & Terbitkan' }}
            </button>
        </div>

    </form>

</div>
@endsection

