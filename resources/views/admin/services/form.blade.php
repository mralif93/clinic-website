@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Perkhidmatan | Sakeenah Medicare')
@section('page_title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Perkhidmatan Terapi')

@section('admin_content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1.5 transition">
            &larr; Kembali ke Senarai Perkhidmatan
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.services.update', $service->id) : route('admin.services.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- 2-Column Responsive Layout Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- Column 1: Main Information (8 cols) --}}
            <div class="lg:col-span-8 space-y-6">
                
                {{-- Card 1: Maklumat Asas & Penerangan --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Maklumat Asas Rawatan</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Nama servis, kategori pengkhususan, dan penerangan klinikal.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Nama Perkhidmatan *</label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', $service->name) }}" 
                                   required 
                                   placeholder="Cth: Psikoterapi Individu (Dewasa)" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Kategori Servis *</label>
                            <input type="text" 
                                   name="category" 
                                   value="{{ old('category', $service->category) }}" 
                                   required 
                                   placeholder="Cth: psychotherapy, assessment, couples" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            @error('category') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Sasaran Pesakit</label>
                        <input type="text" 
                               name="target_audience" 
                               value="{{ old('target_audience', $service->target_audience) }}" 
                               placeholder="Cth: Kanak-kanak, Remaja, Dewasa & Pasangan" 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Ringkasan Pendek (Excerpt)</label>
                        <textarea name="summary" 
                                  rows="2" 
                                  placeholder="Penerangan 1-2 ayat untuk kad paparan servis..." 
                                  class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('summary', $service->summary) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Penerangan Lengkap & Pendekatan Terapi</label>
                        <textarea name="description" 
                                  rows="5" 
                                  placeholder="Objektif rawatan, prosedur penilaian, dan kaedah terapi yang diaplikasikan..." 
                                  class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('description', $service->description) }}</textarea>
                    </div>
                </div>

                {{-- Card 2: Penetapan Yuran & Deposit --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-4">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Kadar Yuran & Tempoh Sesi</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Penetapan harga per sesi, durasi masa dan deposit tempahan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Yuran Penuh (RM) *</label>
                            <input type="number" 
                                   step="0.01" 
                                   name="price" 
                                   value="{{ old('price', $service->price) }}" 
                                   required 
                                   placeholder="200.00" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Deposit Slot (RM) *</label>
                            <input type="number" 
                                   step="0.01" 
                                   name="deposit_amount" 
                                   value="{{ old('deposit_amount', $service->deposit_amount ?: 50) }}" 
                                   required 
                                   placeholder="50.00" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Durasi (Minit) *</label>
                            <input type="number" 
                                   name="duration_minutes" 
                                   value="{{ old('duration_minutes', $service->duration_minutes ?: 60) }}" 
                                   required 
                                   placeholder="60" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                        </div>
                    </div>
                </div>

            </div>

            {{-- Column 2: Media, Status & Actions (4 cols) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Card 3: Imej Banner --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-4">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Imej Banner Servis</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Imej thumbnail bagi kad rawatan.</p>
                    </div>

                    <div class="h-36 rounded-xl bg-neutral-100 overflow-hidden border border-neutral-200">
                        <img id="service-image-preview" 
                             src="{{ asset($service->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" 
                             alt="Pratonton" 
                             class="w-full h-full object-cover">
                    </div>

                    <div>
                        <input type="file" 
                               name="image" 
                               id="service-image-input"
                               accept="image/png,image/jpeg,image/webp" 
                               onchange="previewServiceImage(event)"
                               class="w-full text-xs text-neutral-600 file:mr-2.5 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <input type="hidden" name="image_path" value="{{ old('image_path', $service->image_path) }}">
                        @error('image') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Card 4: Mod Sesi & Tetapan Status --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3.5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Mod & Status</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Kawalan ketersediaan perkhidmatan.</p>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Fizikal Cyberjaya</span>
                            <input type="checkbox" name="allows_in_person" value="1" {{ old('allows_in_person', $service->allows_in_person ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Dalam Talian (Online)</span>
                            <input type="checkbox" name="allows_online" value="1" {{ old('allows_online', $service->allows_online ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Pilihan Utama (Featured)</span>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Status Aktif</span>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-4 border-t border-neutral-100 space-y-2">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs text-center">
                            {{ $isEdit ? 'Kemaskini Perkhidmatan' : 'Daftar Perkhidmatan' }}
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="w-full py-2.5 px-4 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 transition block text-center">
                            Batal
                        </a>
                    </div>
                </div>

            </div>

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
