@extends('layouts.public')

@section('title', 'Lupa Kata Laluan | Sakeenah Medicare')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-[#F4F1EA]/50">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
            <img class="h-12 w-auto mx-auto object-contain" src="{{ asset('media/logos/1.png') }}" alt="Sakeenah Medicare Logo">
        </a>
        <h2 class="mt-4 text-2xl font-extrabold text-neutral-900 tracking-tight">
            Tetapan Semula Kata Laluan
        </h2>
        <p class="mt-1 text-xs text-neutral-500 max-w-xs mx-auto">
            Masukkan emel pentadbir anda dan pautan tetapan semula akan dihantar.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-white py-8 px-6 shadow-sm rounded-3xl border border-neutral-200/90 sm:px-10 space-y-6">
            
            @if(session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold leading-relaxed">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold space-y-1">
                    @foreach($errors->all() as $err)
                        <p>{{ $err }}</p>
                    @endforeach
                </div>
            @endif

            <form class="space-y-4" action="{{ route('admin.password.email') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider mb-1.5">
                        Alamat Emel Pentadbir:
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           placeholder="admin@sakeenahmedicare.net"
                           class="w-full py-3 px-4 rounded-xl border border-neutral-300 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-[#2D6A4F]/20 focus:border-[#2D6A4F] transition">
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 px-4 rounded-full text-sm font-bold text-white bg-[#2D6A4F] hover:bg-[#1E4634] shadow-md transition flex items-center justify-center gap-2">
                        <span>Hantar Pautan Tetapan Semula</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-neutral-100 text-center">
                <a href="{{ route('admin.login') }}" class="text-xs text-[#2D6A4F] font-semibold hover:underline">
                    &larr; Kembali ke Log Masuk
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
