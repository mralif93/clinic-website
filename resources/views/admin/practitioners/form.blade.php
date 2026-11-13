@extends('layouts.admin')

@section('title', ($isEdit ? 'Kemaskini' : 'Daftar') . ' Pakar & Terapis | Sakeenah Medicare')
@section('page_title', $isEdit ? 'Kemaskini Profil Pakar: ' . $practitioner->name : 'Daftar Pakar / Terapis Baharu')

@section('admin_content')
<div class="space-y-6">

    {{-- Header Navigation --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.practitioners.index') }}" class="text-xs font-bold text-neutral-500 hover:text-neutral-800 flex items-center gap-1 transition">
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
            
            {{-- Column 1: Main Content Sections (8 cols) --}}
            <div class="lg:col-span-8 space-y-6">
                
                {{-- KAD 1: Maklumat Asas & Kredensial --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-5">
                    <div class="flex items-center gap-2.5 border-b border-neutral-100 pb-3">
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center font-bold text-xs">1</span>
                        <div>
                            <h3 class="text-sm font-bold text-neutral-900">Maklumat Peribadi & Kelayakan Profesional</h3>
                            <p class="text-xs text-neutral-400">Nama penuh, gelaran profesional dan pendaftaran badan kawal selia.</p>
                        </div>
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
                                  rows="4" 
                                  placeholder="Latar belakang pendidikan, pengalaman klinikal, dan metodologi terapi yang digunakan..." 
                                  class="w-full py-2.5 px-3 rounded-xl border border-neutral-300 text-xs bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-[#2D6A4F]">{{ old('bio', $practitioner->bio) }}</textarea>
                    </div>
                </div>

                {{-- KAD 2: Jadual Hari Bertugas Mingguan --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-4">
                    <div class="flex items-center gap-2.5 border-b border-neutral-100 pb-3">
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center font-bold text-xs">2</span>
                        <div>
                            <h3 class="text-sm font-bold text-neutral-900">Jadual Hari Bertugas Mingguan</h3>
                            <p class="text-xs text-neutral-400">Tandakan hari pakar ini berkhidmat. Hari yang tidak ditandakan dianggap cuti mingguan (off-day).</p>
                        </div>
                    </div>

                    @php
                        $workingDays = old('working_days', $practitioner->working_days ?? ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
                        $daysMap = [
                            'Monday' => 'Isnin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Khamis',
                            'Friday' => 'Jumaat',
                            'Saturday' => 'Sabtu',
                            'Sunday' => 'Ahad',
                        ];
                    @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2">
                        @foreach($daysMap as $dayEn => $dayMy)
                            <label class="flex flex-col items-center justify-center p-2.5 rounded-xl border {{ in_array($dayEn, (array)$workingDays) ? 'bg-emerald-50/70 border-emerald-300' : 'bg-neutral-50 border-neutral-200' }} text-center cursor-pointer hover:bg-neutral-100 transition">
                                <input type="checkbox" name="working_days[]" value="{{ $dayEn }}" {{ in_array($dayEn, (array)$workingDays) ? 'checked' : '' }} class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4 mb-1">
                                <span class="text-xs font-bold text-neutral-800">{{ $dayMy }}</span>
                                <span class="text-[10px] text-neutral-400">{{ substr($dayEn, 0, 3) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- KAD 3: Pilihan & Penjana Slot Masa --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-4">
                    <div class="flex items-center gap-2.5 border-b border-neutral-100 pb-3">
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center font-bold text-xs">3</span>
                        <div>
                            <h3 class="text-sm font-bold text-neutral-900">Pilihan & Penjana Slot Masa Sesi</h3>
                            <p class="text-xs text-neutral-400">Jana slot secara automatik mengikut julat waktu dan selang minit, atau tambah waktu tersuai.</p>
                        </div>
                    </div>

                    {{-- Time Range Generator Toolbar --}}
                    <div class="p-3.5 bg-neutral-50 rounded-2xl border border-neutral-200/90 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                            <span class="text-xs font-bold text-neutral-800">Penjana Slot Masa Automatik (Time Range)</span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            <div>
                                <label class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider mb-1">Waktu Mula:</label>
                                <input type="time" id="gen_start_time" value="09:00" class="w-full py-1.5 px-2.5 rounded-lg border border-neutral-300 text-xs bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider mb-1">Waktu Tamat:</label>
                                <input type="time" id="gen_end_time" value="18:00" class="w-full py-1.5 px-2.5 rounded-lg border border-neutral-300 text-xs bg-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider mb-1">Selang Sesi:</label>
                                <select id="gen_interval" class="w-full py-1.5 px-2.5 rounded-lg border border-neutral-300 text-xs bg-white">
                                    <option value="45">45 Minit</option>
                                    <option value="60">60 Minit (1 Jam)</option>
                                    <option value="90" selected>90 Minit (1.5 Jam)</option>
                                    <option value="120">120 Minit (2 Jam)</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button" onclick="generateTimeSlots()" class="w-full py-2 px-3 rounded-lg bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold shadow-xs transition flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    <span>Jana Slot</span>
                                </button>
                            </div>
                        </div>

                        {{-- Quick Add Custom Time --}}
                        <div class="pt-2 border-t border-neutral-200/60 flex items-center gap-2">
                            <span class="text-[11px] text-neutral-500 shrink-0">Atau tambah masa khas:</span>
                            <input type="text" id="custom_time_input" placeholder="Cth: 08:30 PM" class="w-32 py-1.5 px-2.5 rounded-lg border border-neutral-300 text-xs bg-white">
                            <button type="button" onclick="addCustomSlot()" class="py-1.5 px-3 rounded-lg bg-neutral-200 hover:bg-neutral-300 text-neutral-800 text-xs font-bold transition">
                                + Tambah
                            </button>
                        </div>
                    </div>

                    @php
                        $availableSlots = old('available_slots', $practitioner->available_slots ?? ['10:00 AM', '11:30 AM', '02:00 PM', '03:30 PM', '05:00 PM', '08:00 PM']);
                    @endphp

                    {{-- Active Slots Container --}}
                    <div>
                        <span class="text-[11px] font-bold text-neutral-600 block mb-2">Slot Masa Yang Aktif Dibuka:</span>
                        <div id="slots_container" class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            @foreach((array)$availableSlots as $timeSlot)
                                <div class="slot-item flex items-center justify-between p-2 rounded-xl border bg-emerald-50/70 border-emerald-300 text-xs font-bold text-neutral-800">
                                    <label class="flex items-center gap-2 cursor-pointer grow">
                                        <input type="checkbox" name="available_slots[]" value="{{ $timeSlot }}" checked class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                                        <span>{{ $timeSlot }}</span>
                                    </label>
                                    <button type="button" onclick="removeSlot(this)" class="text-neutral-400 hover:text-rose-600 p-1 rounded-lg transition" title="Padam slot ini">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- KAD 4: Tarikh Cuti & Pelepasan Khas --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 sm:p-6 shadow-2xs space-y-4">
                    <div class="flex items-center gap-2.5 border-b border-neutral-100 pb-3">
                        <span class="w-7 h-7 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-xs">4</span>
                        <div>
                            <h3 class="text-sm font-bold text-neutral-900">Tarikh Cuti / Pelepasan Khas Pakar</h3>
                            <p class="text-xs text-neutral-400">Pakar tidak akan menerima sebarang tempahan pada tarikh-tarikh cuti yang direkodkan.</p>
                        </div>
                    </div>

                    <div class="p-3.5 bg-rose-50/50 border border-rose-200/70 rounded-2xl flex flex-col sm:flex-row items-center gap-2.5">
                        <label class="text-xs font-bold text-rose-900 shrink-0">Rekod Tarikh Cuti Baharu:</label>
                        <input type="date" id="new_leave_date" min="{{ date('Y-m-d') }}" class="w-full sm:w-auto py-1.5 px-3 rounded-lg border border-neutral-300 text-xs bg-white">
                        <button type="button" onclick="addLeaveDate()" class="w-full sm:w-auto py-1.5 px-3 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition shadow-2xs">
                            + Rekod Cuti
                        </button>
                    </div>

                    @php
                        $blockedDates = old('blocked_dates', $practitioner->blocked_dates ?? []);
                    @endphp

                    <div>
                        <span class="text-[11px] font-bold text-neutral-600 block mb-2">Senarai Tarikh Cuti Berkuat Kuasa:</span>
                        <div id="leave_dates_container" class="flex flex-wrap gap-2">
                            @forelse((array)$blockedDates as $dateItem)
                                <div class="leave-item inline-flex items-center gap-2 py-1.5 px-3 rounded-xl border border-rose-200 bg-rose-50 text-xs font-semibold text-rose-800">
                                    <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ date('d M Y (D)', strtotime($dateItem)) }}</span>
                                    <input type="hidden" name="blocked_dates[]" value="{{ $dateItem }}">
                                    <button type="button" onclick="removeLeaveDate(this)" class="text-rose-400 hover:text-rose-700 font-bold ml-1" title="Batal Cuti">&times;</button>
                                </div>
                            @empty
                                <p id="no_leave_msg" class="text-xs text-neutral-400 italic">Tiada tarikh cuti khas direkodkan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

            {{-- Column 2: Photo, Mode & Status Actions (4 cols) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- KAD 5: Foto Profil Pakar --}}
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

                {{-- KAD 6: Mod Sesi & Tindakan Status --}}
                <div class="bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-2xs space-y-3.5">
                    <div class="border-b border-neutral-100 pb-3">
                        <h3 class="text-sm font-bold text-neutral-900">Mod Konsultasi & Status</h3>
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

        function formatTime12H(hours, minutes) {
            const period = hours >= 12 ? 'PM' : 'AM';
            let h = hours % 12;
            if (h === 0) h = 12;
            const hStr = h < 10 ? '0' + h : '' + h;
            const mStr = minutes < 10 ? '0' + minutes : '' + minutes;
            return `${hStr}:${mStr} ${period}`;
        }

        function createSlotHtml(timeStr) {
            return `
                <div class="slot-item flex items-center justify-between p-2 rounded-xl border bg-emerald-50/70 border-emerald-300 text-xs font-bold text-neutral-800">
                    <label class="flex items-center gap-2 cursor-pointer grow">
                        <input type="checkbox" name="available_slots[]" value="${timeStr}" checked class="rounded text-[#2D6A4F] focus:ring-[#2D6A4F] w-4 h-4">
                        <span>${timeStr}</span>
                    </label>
                    <button type="button" onclick="removeSlot(this)" class="text-neutral-400 hover:text-rose-600 p-1 rounded-lg transition" title="Padam slot ini">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            `;
        }

        function generateTimeSlots() {
            const startVal = document.getElementById('gen_start_time').value; // "09:00"
            const endVal = document.getElementById('gen_end_time').value; // "18:00"
            const interval = parseInt(document.getElementById('gen_interval').value, 10); // 45, 60, 90, 120

            if (!startVal || !endVal) {
                alert('Sila tentukan waktu mula dan waktu tamat.');
                return;
            }

            const [startH, startM] = startVal.split(':').map(Number);
            const [endH, endM] = endVal.split(':').map(Number);

            let currentMinutes = startH * 60 + startM;
            const endMinutes = endH * 60 + endM;

            if (currentMinutes >= endMinutes) {
                alert('Waktu tamat mestilah selepas waktu mula.');
                return;
            }

            const container = document.getElementById('slots_container');
            const existingInputs = container.querySelectorAll('input[name="available_slots[]"]');
            const existingValues = Array.from(existingInputs).map(i => i.value.trim());

            let addedCount = 0;
            while (currentMinutes + interval <= endMinutes) {
                const h = Math.floor(currentMinutes / 60);
                const m = currentMinutes % 60;
                const formatted = formatTime12H(h, m);

                if (!existingValues.includes(formatted)) {
                    container.insertAdjacentHTML('beforeend', createSlotHtml(formatted));
                    existingValues.push(formatted);
                    addedCount++;
                }
                currentMinutes += interval;
            }

            if (addedCount === 0) {
                alert('Semua slot dalam julat ini telah wujud.');
            }
        }

        function addCustomSlot() {
            const input = document.getElementById('custom_time_input');
            const val = input.value.trim().toUpperCase();

            if (!val) return;

            const container = document.getElementById('slots_container');
            const existingInputs = container.querySelectorAll('input[name="available_slots[]"]');
            const existingValues = Array.from(existingInputs).map(i => i.value.trim());

            if (existingValues.includes(val)) {
                alert('Slot masa ini telah wujud.');
                return;
            }

            container.insertAdjacentHTML('beforeend', createSlotHtml(val));
            input.value = '';
        }

        function removeSlot(btn) {
            const item = btn.closest('.slot-item');
            if (item) {
                item.remove();
            }
        }

        function addLeaveDate() {
            const input = document.getElementById('new_leave_date');
            const dateVal = input.value;

            if (!dateVal) {
                alert('Sila pilih tarikh cuti.');
                return;
            }

            const container = document.getElementById('leave_dates_container');
            const existingInputs = container.querySelectorAll('input[name="blocked_dates[]"]');
            const existingValues = Array.from(existingInputs).map(i => i.value);

            if (existingValues.includes(dateVal)) {
                alert('Tarikh cuti ini telah ditambah.');
                return;
            }

            const noMsg = document.getElementById('no_leave_msg');
            if (noMsg) noMsg.remove();

            const d = new Date(dateVal);
            const dateDisplay = d.toLocaleDateString('ms-MY', { day: '2-digit', month: 'short', year: 'numeric', weekday: 'short' });

            const html = `
                <div class="leave-item inline-flex items-center gap-2 py-1.5 px-3 rounded-xl border border-rose-200 bg-rose-50 text-xs font-semibold text-rose-800">
                    <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>${dateDisplay}</span>
                    <input type="hidden" name="blocked_dates[]" value="${dateVal}">
                    <button type="button" onclick="removeLeaveDate(this)" class="text-rose-400 hover:text-rose-700 font-bold ml-1" title="Batal Cuti">&times;</button>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
            input.value = '';
        }

        function removeLeaveDate(btn) {
            const item = btn.closest('.leave-item');
            if (item) {
                item.remove();
            }
        }
    </script>

</div>
@endsection
