@extends('layouts.app')

@section('title', 'Daftar Personalia')

@section('content')
<div class="w-full space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-1">Personalia Anda</h1>
            <p class="text-gray-500 text-[15px]">Kelola karakter dan identitas asisten Ai anda.</p>
        </div>
        <a href="{{ route('personas.create') }}" class="px-5 py-2.5 bg-[#8cb400] text-white text-sm font-semibold rounded-xl hover:bg-[#7a9d00] transition-colors duration-300 flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Persona Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 text-green-700 px-4 py-3 rounded-xl text-sm border border-green-100 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 text-red-700 px-4 py-3 rounded-xl text-sm border border-red-100 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($personas as $persona)
        <a href="{{ route('personas.show', $persona) }}" class="group block bg-white rounded-[20px] p-6 border border-gray-100/60 shadow-sm hover:border-[#8cb400]/50 hover:shadow-md transition-all duration-300 flex flex-col h-full relative">
            <div class="flex justify-between items-start mb-5">
                <div class="w-12 h-12 bg-[#8cb400]/10 rounded-full flex items-center justify-center transition-colors duration-300 group-hover:bg-[#8cb400] group-hover:text-white text-[#8cb400]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                
                <!-- Quick Edit Action -->
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200" onclick="event.preventDefault(); window.location.href='{{ route('personas.edit', $persona) }}'">
                    <button class="p-2 text-gray-400 hover:text-[#8cb400] hover:bg-gray-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <h3 class="text-lg font-bold text-gray-900 mb-2 truncate group-hover:text-[#8cb400] transition-colors duration-300">{{ $persona->persona_name }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed line-clamp-2 min-h-[40px]">{{ $persona->role_summary ?? 'Tidak ada ringkasan peran.' }}</p>
            
            <div class="flex items-center justify-between text-[11px] font-medium text-gray-400 mt-6 pt-5 border-t border-gray-50">
                <span class="uppercase">ID {{ $persona->id }}</span>
                <span>{{ str_replace('yang lalu', 'hari yang lalu', $persona->created_at->diffForHumans()) }}</span>
            </div>
        </a>
        @empty
        <div class="col-span-full py-20 text-center bg-white rounded-[20px] border border-dashed border-gray-200">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#8cb400]/10 mb-5 text-[#8cb400]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada persona</h3>
            <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Mulai dengan membuat identitas AI pertama Anda untuk mulai mengkonfigurasi asisten cerdas.</p>
            <a href="{{ route('personas.create') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent shadow-sm text-sm font-semibold rounded-xl text-white bg-[#8cb400] hover:bg-[#7a9d00] transition-all duration-300">
                <svg class="-ml-1 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Persona Baru
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
