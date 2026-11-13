@extends('layouts.admin')

@section('page_title', 'Pengurusan Perkhidmatan')

@section('admin_content')
<div class="space-y-6">

    {{-- Header Actions --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-neutral-900 tracking-tight">Katalog Perkhidmatan dan Sesi Terapi</h2>
            <p class="text-xs text-neutral-500 mt-1 leading-relaxed">
                Urus pakej rawatan, kadar yuran sesi, deposit tempahan, dan mod konsultasi klinik.
            </p>
        </div>
        <a href="{{ route('admin.services.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Perkhidmatan
        </a>
    </div>

    {{-- Search & Filter Card --}}
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200/90 shadow-2xs space-y-3">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-2.5">
            <div class="flex items-center gap-2 text-neutral-800">
                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-[#2D6A4F] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-neutral-700">Carian & Tapisan Perkhidmatan</h3>
            </div>
            <span class="text-[11px] text-neutral-400">Tapis katalog mengikut nama, kategori rawatan atau status</span>
        </div>

        <form method="GET" action="{{ route('admin.services.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 pt-0.5">
            {{-- Keyword Search --}}
            <div class="grow relative">
                <input type="text" 
                       name="q" 
                       value="{{ $search }}" 
                       placeholder="Cari nama perkhidmatan, kata kunci, sasaran rawatan..." 
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
                    <option value="active" {{ $selectedStatus === 'active' ? 'selected' : '' }}>Aktif Sahaja</option>
                    <option value="inactive" {{ $selectedStatus === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
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
                    <a href="{{ route('admin.services.index') }}" class="h-10 px-3.5 rounded-xl border border-neutral-200 text-xs font-semibold text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Services Table --}}
    <div class="bg-white rounded-2xl border border-neutral-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-neutral-50/80 border-b border-neutral-200 text-neutral-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-4 min-w-[280px]">Perkhidmatan</th>
                        <th class="py-3.5 px-4 min-w-[160px]">Kategori / Sasaran</th>
                        <th class="py-3.5 px-4 min-w-[130px]">Durasi & Yuran</th>
                        <th class="py-3.5 px-4 min-w-[100px]">Deposit</th>
                        <th class="py-3.5 px-4 min-w-[140px]">Mod Sesi</th>
                        <th class="py-3.5 px-4 min-w-[90px]">Status</th>
                        <th class="py-3.5 px-4 text-right min-w-[90px]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($services as $service)
                        <tr class="hover:bg-neutral-50/60 transition group">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200 shadow-2xs">
                                        <img src="{{ asset($service->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-bold text-neutral-900 block text-xs sm:text-sm leading-snug group-hover:text-[#2D6A4F] transition-colors">
                                            {{ $service->name }}
                                        </span>
                                        @if($service->is_featured)
                                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase tracking-wider">
                                                Utama
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-neutral-100 text-neutral-700 mb-1">
                                    {{ ucfirst(str_replace('_', ' ', $service->category)) }}
                                </span>
                                <span class="text-[11px] text-neutral-500 block truncate max-w-[150px]">
                                    {{ $service->target_audience ?: 'Umum' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-neutral-900 block">
                                    {{ $service->price > 0 ? 'RM ' . number_format($service->price, 2) : 'Sebut Harga' }}
                                </span>
                                <span class="text-[11px] text-neutral-500 block">
                                    {{ $service->duration_minutes }} Minit
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-[#2D6A4F] block">
                                    RM {{ number_format($service->deposit_amount, 2) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-[11px]">
                                <div class="space-y-0.5">
                                    @if($service->allows_in_person)
                                        <div class="flex items-center gap-1.5 text-neutral-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>Fizikal (Cyberjaya)</span>
                                        </div>
                                    @endif
                                    @if($service->allows_online)
                                        <div class="flex items-center gap-1.5 text-neutral-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                            <span>Dalam Talian</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($service->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" 
                                       class="p-2 rounded-lg text-neutral-500 hover:text-[#2D6A4F] hover:bg-emerald-50 transition"
                                       title="Kemaskini">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Adakah anda pasti ingin memadamkan pakej perkhidmatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg text-neutral-400 hover:text-rose-600 hover:bg-rose-50 transition"
                                                title="Padam">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-neutral-400">
                                <p class="text-xs">Tiada rekod perkhidmatan dijumpai bagi kriteria carian atau tapisan ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($services->hasPages())
            <div class="p-4 border-t border-neutral-100">
                {{ $services->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
