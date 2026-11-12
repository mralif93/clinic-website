@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Perkhidmatan | Sakeenah Medicare')
@section('page_title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Perkhidmatan Terapi')

@section('admin_content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1">
            &larr; Kembali ke Senarai Perkhidmatan
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.services.update', $service->id) : route('admin.services.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-3xl border border-neutral-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="border-b border-neutral-100 pb-4">
            <h3 class="text-base font-bold text-neutral-900">Maklumat Perkhidmatan</h3>
            <p class="text-xs text-neutral-500 mt-0.5">Sediakan penerangan jelas untuk dipaparkan di portal awam dan borang tempahan.</p>
        </div>

        {{-- Row 1: Nama & Kategori --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Nama Perkhidmatan *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $service->name) }}" 
                       required 
                       placeholder="Cth: Psikoterapi Individu (Dewasa)" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Kategori *</label>
                <input type="text" 
                       name="category" 
                       value="{{ old('category', $service->category) }}" 
                       required 
                       placeholder="Cth: psychotherapy, assessment, couples, speech" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                @error('category') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Row 2: Sasaran & Durasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Sasaran Pesakit</label>
                <input type="text" 
                       name="target_audience" 
                       value="{{ old('target_audience', $service->target_audience) }}" 
                       placeholder="Cth: Dewasa & Remaja (16+)" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Yuran Penuh (RM) *</label>
                <input type="number" 
                       step="0.01" 
                       name="price" 
                       value="{{ old('price', $service->price) }}" 
                       required 
                       placeholder="200.00" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Deposit Tempahan (RM) *</label>
                <input type="number" 
                       step="0.01" 
                       name="deposit_amount" 
                       value="{{ old('deposit_amount', $service->deposit_amount ?: 50) }}" 
                       required 
                       placeholder="50.00" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>
        </div>

        {{-- Row 3: Durasi & Muat Naik Imej Servis --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Durasi Sesi (Minit) *</label>
                <input type="number" 
                       name="duration_minutes" 
                       value="{{ old('duration_minutes', $service->duration_minutes ?: 60) }}" 
                       required 
                       placeholder="60" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Imej Banner Perkhidmatan</label>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200 shadow-2xs">
                        <img id="service-image-preview" 
                             src="{{ asset($service->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" 
                             alt="Pratonton" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <input type="file" 
                               name="image" 
                               id="service-image-input"
                               accept="image/png,image/jpeg,image/webp" 
                               onchange="previewServiceImage(event)"
                               class="w-full text-xs text-neutral-600 file:mr-2.5 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    </div>
                </div>
                <input type="hidden" name="image_path" value="{{ old('image_path', $service->image_path) }}">
                @error('image') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Ringkasan & Penerangan --}}
        <div>
            <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Ringkasan Pendek</label>
            <textarea name="summary" 
                      rows="2" 
                      placeholder="Penerangan ringkas untuk kad senarai servis..." 
                      class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('summary', $service->summary) }}</textarea>
        </div>

        <div>
            <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Penerangan Lengkap</label>
            <textarea name="description" 
                      rows="4" 
                      placeholder="Penerangan lanjut, objektif sesi, dan pendekatan terapi..." 
                      class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('description', $service->description) }}</textarea>
        </div>

        {{-- Checkbox Options --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-2xl bg-neutral-50 border border-neutral-200/80">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="allows_in_person" value="1" {{ old('allows_in_person', $service->allows_in_person ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Fizikal Cyberjaya</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="allows_online" value="1" {{ old('allows_online', $service->allows_online ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Dalam Talian (Online)</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Pilihan Utama</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Aktif</span>
            </label>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl border border-neutral-300 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs">
                {{ $isEdit ? 'Kemaskini Perkhidmatan' : 'Daftar Perkhidmatan' }}
            </button>
        </div>
    </form>

    <script>
        function previewServiceImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('service-image-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</div>
@endsection

