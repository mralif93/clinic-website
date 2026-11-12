@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Profil Pakar | Sakeenah Medicare')
@section('page_title', ($isEdit ? 'Kemaskini' : 'Tambah') . ' Profil Pakar Terapi')

@section('admin_content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.practitioners.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1">
            &larr; Kembali ke Direktori Pakar
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.practitioners.update', $practitioner->id) : route('admin.practitioners.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-3xl border border-neutral-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="border-b border-neutral-100 pb-4">
            <h3 class="text-base font-bold text-neutral-900">Maklumat Peribadi & Kelayakan Pakar</h3>
            <p class="text-xs text-neutral-500 mt-0.5">Maklumat ini akan dipaparkan pada senarai terapis dan pilihan pakar semasa tempahan.</p>
        </div>

        {{-- Row 1: Nama & Gelaran --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Nama Penuh & Gelaran *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $practitioner->name) }}" 
                       required 
                       placeholder="Cth: CL Adeera" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Jawatan Profesional *</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $practitioner->title) }}" 
                       required 
                       placeholder="Cth: Pegawai Psikologi & Kaunselor Berdaftar" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
                @error('title') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Row 2: No Pendaftaran & Muat Naik Foto Profil --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">No. Pendaftaran (LKM / MAHPC)</label>
                <input type="text" 
                       name="registration_number" 
                       value="{{ old('registration_number', $practitioner->registration_number) }}" 
                       placeholder="Cth: KB08123 / PA07654" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Foto Profil Pakar</label>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200 shadow-2xs">
                        <img id="photo-preview" 
                             src="{{ asset($practitioner->photo_path ?: 'media/team/CL Adeera.png') }}" 
                             alt="Pratonton" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <input type="file" 
                               name="photo" 
                               id="photo-input"
                               accept="image/png,image/jpeg,image/webp" 
                               onchange="previewImage(event)"
                               class="w-full text-xs text-neutral-600 file:mr-2.5 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    </div>
                </div>
                <input type="hidden" name="photo_path" value="{{ old('photo_path', $practitioner->photo_path) }}">
                @error('photo') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Row 3: Kepakaran & Bahasa --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Bidang Kepakaran (Pisahkan dengan koma)</label>
                <input type="text" 
                       name="specialties" 
                       value="{{ old('specialties', is_array($practitioner->specialties) ? implode(', ', $practitioner->specialties) : $practitioner->specialties) }}" 
                       placeholder="Cth: Kebimbangan, Depresi, Terapi Pasangan, Trauma" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Bahasa Konsultasi (Pisahkan dengan koma)</label>
                <input type="text" 
                       name="languages" 
                       value="{{ old('languages', is_array($practitioner->languages) ? implode(', ', $practitioner->languages) : 'Bahasa Melayu, English') }}" 
                       placeholder="Cth: Bahasa Melayu, English" 
                       class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">
            </div>
        </div>

        {{-- Biodata Ringkas --}}
        <div>
            <label class="block text-[11px] font-bold text-neutral-600 uppercase tracking-wider mb-1.5">Biodata & Latar Belakang Klinikal</label>
            <textarea name="bio" 
                      rows="4" 
                      placeholder="Latar belakang pendidikan, pengalaman klinikal, dan metodologi terapi yang digunakan..." 
                      class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('bio', $practitioner->bio) }}</textarea>
        </div>

        {{-- Checkbox Options --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-2xl bg-neutral-50 border border-neutral-200/80">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="accepts_in_person" value="1" {{ old('accepts_in_person', $practitioner->accepts_in_person ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Terima Sesi Fizikal (Cyberjaya)</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="accepts_online" value="1" {{ old('accepts_online', $practitioner->accepts_online ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Terima Sesi Dalam Talian</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $practitioner->is_active ?? true) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F]">
                <span class="text-xs font-semibold text-neutral-700">Status Aktif (Boleh Ditempah)</span>
            </label>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-100">
            <a href="{{ route('admin.practitioners.index') }}" class="px-5 py-2.5 rounded-xl border border-neutral-300 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs">
                {{ $isEdit ? 'Kemaskini Profil Pakar' : 'Daftar Pakar Terapi' }}
            </button>
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

