@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Profil Pakar | Sakeenah Medicare')
@section('page_title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Profil Pakar Terapi')

@section('admin_content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.practitioners.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1.5 transition">
            &larr; Kembali ke Direktori Pakar
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.practitioners.update', $practitioner->id) : route('admin.practitioners.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- 2-Column Responsive Layout Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- Column 1: Main Practitioner Info (8 cols) --}}
            <div class="lg:col-span-8 space-y-6">
                
                {{-- Card 1: Maklumat Asas & Kredensial --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Maklumat Peribadi & Kelayakan Pakar</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Nama penuh, gelaran profesional dan pendaftaran badan kawal selia.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Nama Penuh & Gelaran *</label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', $practitioner->name) }}" 
                                   required 
                                   placeholder="Cth: CL Adeera" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Jawatan Profesional *</label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $practitioner->title) }}" 
                                   required 
                                   placeholder="Cth: Pegawai Psikologi & Kaunselor Berdaftar" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                            @error('title') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">No. Pendaftaran (LKM / MAHPC)</label>
                        <input type="text" 
                               name="registration_number" 
                               value="{{ old('registration_number', $practitioner->registration_number) }}" 
                               placeholder="Cth: KB08123 / PA07654" 
                               class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Bidang Kepakaran (Pisahkan koma)</label>
                            <input type="text" 
                                   name="specialties" 
                                   value="{{ old('specialties', is_array($practitioner->specialties) ? implode(', ', $practitioner->specialties) : $practitioner->specialties) }}" 
                                   placeholder="Cth: Kebimbangan, Depresi, Terapi Pasangan" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Bahasa Konsultasi (Pisahkan koma)</label>
                            <input type="text" 
                                   name="languages" 
                                   value="{{ old('languages', is_array($practitioner->languages) ? implode(', ', $practitioner->languages) : 'Bahasa Melayu, English') }}" 
                                   placeholder="Cth: Bahasa Melayu, English" 
                                   class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-neutral-700 uppercase tracking-wider mb-1.5">Biodata & Latar Belakang Klinikal</label>
                        <textarea name="bio" 
                                  rows="6" 
                                  placeholder="Latar belakang pendidikan, pengalaman klinikal, dan metodologi terapi yang digunakan..." 
                                  class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('bio', $practitioner->bio) }}</textarea>
                    </div>
                </div>

            </div>

            {{-- Column 2: Photo, Mode & Status Actions (4 cols) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Card 2: Foto Profil --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-4 text-center">
                    <div class="border-b border-neutral-100 pb-3 text-left">
                        <h3 class="text-sm font-bold text-neutral-900">Foto Profil Pakar</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Potret rasmi ahli terapi.</p>
                    </div>

                    <div class="w-28 h-28 mx-auto rounded-full bg-neutral-100 overflow-hidden border-2 border-neutral-200 shadow-xs">
                        <img id="photo-preview" 
                             src="{{ asset($practitioner->photo_path ?: 'media/team/CL Adeera.png') }}" 
                             alt="Pratonton" 
                             class="w-full h-full object-cover">
                    </div>

                    <div>
                        <input type="file" 
                               name="photo" 
                               id="photo-input"
                               accept="image/png,image/jpeg,image/webp" 
                               onchange="previewImage(event)"
                               class="w-full text-xs text-neutral-600 file:mr-2.5 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <input type="hidden" name="photo_path" value="{{ old('photo_path', $practitioner->photo_path) }}">
                        @error('photo') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Card 3: Mod Sesi & Ketersediaan --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3.5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Ketersediaan & Mod</h3>
                        <p class="text-xs text-neutral-400 mt-0.5">Penerimaan sesi temu janji.</p>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Fizikal (Cyberjaya)</span>
                            <input type="checkbox" name="accepts_in_person" value="1" {{ old('accepts_in_person', $practitioner->accepts_in_person ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Dalam Talian (Online)</span>
                            <input type="checkbox" name="accepts_online" value="1" {{ old('accepts_online', $practitioner->accepts_online ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>

                        <label class="flex items-center justify-between p-2.5 rounded-xl bg-neutral-50 border border-neutral-200/70 cursor-pointer hover:bg-neutral-100/60 transition">
                            <span class="text-xs font-semibold text-neutral-700">Status Aktif Bertugas</span>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $practitioner->is_active ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 border-t border-neutral-100 space-y-2">
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs text-center">
                            {{ $isEdit ? 'Kemaskini Profil Pakar' : 'Daftar Pakar Terapi' }}
                        </button>
                        <a href="{{ route('admin.practitioners.index') }}" class="w-full py-2.5 px-4 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 transition block text-center">
                            Batal
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</div>
@endsection
