@extends('layouts.admin')

@section('title', 'Perincian Temujanji Google Calendar | Sakeenah Medicare')
@section('page_title', 'Perincian Temujanji Google Calendar')

@section('admin_content')
<div class="space-y-6">

    {{-- Top Back Nav & Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-neutral-200">
        <div>
            <nav class="flex items-center gap-2 text-xs text-neutral-400 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-700 transition">Portal Pentadbiran</a>
                <span>/</span>
                <a href="{{ route('admin.google-calendar.index') }}" class="hover:text-emerald-700 transition">Google Calendar</a>
                <span>/</span>
                <span class="text-neutral-700 font-medium">Perincian Penuh</span>
            </nav>
            <h1 class="text-2xl font-bold text-neutral-900 tracking-tight flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-sm font-bold shadow-xs">
                    📅
                </span>
                {{ $event->summary }}
            </h1>
            <p class="text-xs text-neutral-500 mt-0.5">
                Disegerakkan terakhir pada: {{ $event->last_synced_at ? $event->last_synced_at->timezone(config('app.timezone'))->format('d M Y, h:i A') : 'N/A' }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.google-calendar.index') }}" 
               class="px-4 py-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-50 text-neutral-700 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Senarai</span>
            </a>

            @if($event->html_link)
                <a href="{{ $event->html_link }}" target="_blank" rel="noopener noreferrer" 
                   class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-xs">
                    <span>Buka di Google Calendar</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            @endif
        </div>
    </div>

    {{-- Main Grid Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left 2 Cols: Main Event Info --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Event Details Card --}}
            <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 sm:p-8 space-y-6 shadow-2xs">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-4">
                    <h2 class="text-base font-bold text-neutral-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Perincian Acara / Temujanji
                    </h2>
                    @if(strtolower($event->status) === 'cancelled')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                            Dibatalkan
                        </span>
                    @elseif($event->start_time->isPast())
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-neutral-100 text-neutral-600 border border-neutral-200">
                            Telah Selesai
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Aktif / Sah
                        </span>
                    @endif
                </div>

                {{-- Key Facts Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                    <div class="p-4 rounded-2xl bg-neutral-50/70 border border-neutral-100 space-y-1">
                        <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Tajuk Sesi / Acara</span>
                        <strong class="text-sm text-neutral-900 block font-bold">{{ $event->summary }}</strong>
                    </div>

                    <div class="p-4 rounded-2xl bg-neutral-50/70 border border-neutral-100 space-y-1">
                        <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Penganjur / Organizer</span>
                        <strong class="text-sm text-neutral-900 block font-medium">
                            {{ $event->organizer_email ?: 'Sakeenah Medicare Clinic' }}
                        </strong>
                    </div>

                    <div class="p-4 rounded-2xl bg-neutral-50/70 border border-neutral-100 space-y-1">
                        <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Tarikh</span>
                        <strong class="text-sm text-neutral-900 block font-bold">
                            {{ $event->start_time->format('d F Y (l)') }}
                        </strong>
                    </div>

                    <div class="p-4 rounded-2xl bg-neutral-50/70 border border-neutral-100 space-y-1">
                        <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Masa & Tempoh</span>
                        <strong class="text-sm text-emerald-800 block font-bold">
                            @if($event->is_all_day)
                                Sepanjang Hari (All Day)
                            @else
                                {{ $event->start_time->format('h:i A') }}
                                @if($event->end_time)
                                    - {{ $event->end_time->format('h:i A') }}
                                    <span class="text-neutral-400 font-normal text-xs">({{ $event->start_time->diffInMinutes($event->end_time) }} minit)</span>
                                @endif
                            @endif
                        </strong>
                    </div>
                </div>

                {{-- Location / Meet link --}}
                <div class="pt-4 border-t border-neutral-100 space-y-2 text-xs">
                    <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Lokasi / Mod Sesi</span>
                    @if($event->location)
                        @if(str_contains(strtolower($event->location), 'http'))
                            <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-blue-50/70 border border-blue-200 text-blue-900">
                                <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold shrink-0">
                                    🌐
                                </div>
                                <div class="grow min-w-0">
                                    <span class="block text-[11px] font-bold text-blue-800">Sesi Tele-therapy Dalam Talian (Google Meet / Pautan)</span>
                                    <a href="{{ $event->location }}" target="_blank" rel="noopener noreferrer" class="text-xs text-blue-600 underline font-semibold truncate block hover:text-blue-800">
                                        {{ $event->location }}
                                    </a>
                                </div>
                                <a href="{{ $event->location }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shrink-0 transition">
                                    Sertai Sesi &rarr;
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-2 p-3.5 rounded-2xl bg-neutral-50 border border-neutral-200/80 text-neutral-800">
                                <span class="text-base">📍</span>
                                <span class="font-bold text-xs">{{ $event->location }}</span>
                            </div>
                        @endif
                    @else
                        <div class="p-3.5 rounded-2xl bg-neutral-50 border border-neutral-200/80 text-neutral-500 italic text-xs">
                            Sakeenah Medicare Clinic (Cyberjaya) / Tiada maklumat lokasi khusus.
                        </div>
                    @endif
                </div>

                {{-- Description / Notes --}}
                @php
                    $cleanNotes = \App\Helpers\GoogleCalendarHelper::cleanDescription($event->description);
                    $extractedMeet = \App\Helpers\GoogleCalendarHelper::extractMeetUrl($event->location, $event->description);
                @endphp
                <div class="pt-4 border-t border-neutral-100 space-y-2 text-xs">
                    <span class="text-neutral-400 block text-[11px] font-semibold uppercase tracking-wider">Nota & Penerangan Lengkap</span>
                    <div class="p-4 rounded-2xl bg-[#FBFBFB] border border-neutral-200/80 text-neutral-700 leading-relaxed text-xs whitespace-pre-line min-h-[100px]">
                        {{ $cleanNotes ?: 'Tiada sebarang catatan atau penerangan tambahan direkodkan untuk acara ini di Google Calendar.' }}
                    </div>
                </div>

            </div>

        </div>

        {{-- Right Col: Attendees, Quick Metadata & Actions --}}
        <div class="space-y-6">

            {{-- Attendees List Card --}}
            <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 space-y-4 shadow-2xs">
                <div class="flex items-center justify-between border-b border-neutral-100 pb-3">
                    <h3 class="text-sm font-bold text-neutral-900 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Senarai Peserta (Attendees)</span>
                    </h3>
                    <span class="px-2 py-0.5 rounded-full bg-neutral-100 text-[10px] font-bold text-neutral-600">
                        {{ !empty($event->attendees) ? count($event->attendees) : 0 }} orang
                    </span>
                </div>

                @if(!empty($event->attendees) && count($event->attendees) > 0)
                    <div class="space-y-2.5">
                        @foreach($event->attendees as $attendee)
                            <div class="p-3 rounded-2xl bg-neutral-50/80 border border-neutral-100 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0">
                                        {{ strtoupper(substr($attendee, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-xs font-semibold text-neutral-800 truncate" title="{{ $attendee }}">
                                            {{ $attendee }}
                                        </span>
                                    </div>
                                </div>
                                <a href="mailto:{{ $attendee }}" class="p-1 text-neutral-400 hover:text-emerald-700 transition" title="Hantar Emel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-neutral-400 italic py-2">
                        Tiada emel peserta khusus yang dijemput ke acara ini.
                    </p>
                @endif
            </div>

            {{-- Metadata Box --}}
            <div class="bg-white rounded-3xl border border-neutral-200/90 p-6 space-y-3 shadow-2xs text-xs">
                <h3 class="text-xs font-bold text-neutral-700 uppercase tracking-wider border-b border-neutral-100 pb-2">
                    Maklumat Sistem & Integrasi
                </h3>

                <div class="space-y-2 text-[11px]">
                    <div class="flex justify-between">
                        <span class="text-neutral-400">Punca Data:</span>
                        <span class="font-bold text-neutral-700">Google Calendar (iCal)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-neutral-400">ID Acara Google:</span>
                        <span class="font-mono text-neutral-600 text-[10px] truncate max-w-[150px]" title="{{ $event->google_event_id }}">
                            {{ $event->google_event_id }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-neutral-400">Disegerakkan Pada:</span>
                        <span class="text-neutral-700 font-medium">
                            {{ $event->last_synced_at ? $event->last_synced_at->diffForHumans() : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

