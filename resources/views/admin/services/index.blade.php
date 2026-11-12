@extends('layouts.admin')

@section('page_title', 'Pengurusan Perkhidmatan')

@section('admin_content')
<div class="space-y-6">

    {{-- Header Actions --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-neutral-900 tracking-tight">Katalog Perkhidmatan & Sesi Terapi</h2>
            <p class="text-xs text-neutral-500 mt-1">Urus pakej rawatan, kadar yuran sesi, deposit tempahan, dan mod konsultasi.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2D6A4F] hover:bg-[#1E4634] text-white text-xs font-bold transition shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Perkhidmatan
        </a>
    </div>

    {{-- Services Table --}}
    <div class="bg-white rounded-2xl border border-neutral-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-neutral-50/80 border-b border-neutral-200 text-neutral-600 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-4">Perkhidmatan</th>
                        <th class="py-3.5 px-4">Kategori / Sasaran</th>
                        <th class="py-3.5 px-4">Durasi & Yuran</th>
                        <th class="py-3.5 px-4">Deposit</th>
                        <th class="py-3.5 px-4">Mod Sesi</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($services as $service)
                        <tr class="hover:bg-neutral-50/60 transition">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-neutral-100 overflow-hidden shrink-0 border border-neutral-200">
                                        <img src="{{ asset($service->image_path ?: 'media/services/Better-therapy-thumbnail.jpg') }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <span class="font-bold text-neutral-900 block text-xs sm:text-sm">{{ $service->name }}</span>
                                        @if($service->is_featured)
                                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-100 text-amber-800 uppercase">Utama</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-neutral-600">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-neutral-100 text-neutral-700 block w-fit mb-1">
                                    {{ ucfirst($service->category) }}
                                </span>
                                <span class="text-[11px] text-neutral-400">{{ $service->target_audience ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-neutral-900 block">RM {{ number_format($service->price, 2) }}</span>
                                <span class="text-[11px] text-neutral-500">{{ $service->duration_minutes }} Minit</span>
                            </td>
                            <td class="py-4 px-4 font-semibold text-emerald-700">
                                RM {{ number_format($service->deposit_amount, 2) }}
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex flex-col gap-1">
                                    @if($service->allows_in_person)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-medium text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Fizikal (Cyberjaya)
                                        </span>
                                    @endif
                                    @if($service->allows_online)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-medium text-blue-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Dalam Talian
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($service->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-neutral-200 text-neutral-600">
                                        Dinyahaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" 
                                       class="p-1.5 rounded-lg text-neutral-500 hover:text-neutral-900 hover:bg-neutral-100 transition" 
                                       title="Kemaskini">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Adakah anda pasti ingin memadam perkhidmatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition" 
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
                                Tiada perkhidmatan didaftarkan setakat ini.
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

