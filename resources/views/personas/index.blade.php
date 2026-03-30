@extends('layouts.app')

@section('title', 'Daftar Personalia')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight mb-2">Personalia Anda</h1>
            <p class="text-gray-500 text-base md:text-lg font-light">Kelola karakter dan identitas asisten AI Anda.</p>
        </div>
        <a href="{{ route('personas.create') }}" class="w-full md:w-auto justify-center px-6 py-3 bg-gray-900 text-[#d4af37] text-sm font-medium rounded-lg shadow-lg shadow-gray-900/20 hover:bg-black hover:shadow-xl hover:shadow-gray-900/30 transition-all duration-300 flex items-center border border-transparent">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Persona Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($personas as $persona)
        <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full">
            <div class="flex justify-between items-start mb-5">
                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-gray-900 group-hover:text-[#d4af37] transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <a href="{{ route('personas.edit', $persona) }}" class="p-2 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <a href="{{ route('personas.show', $persona) }}" class="block flex-1 mb-6">
                <h3 class="text-xl font-medium text-gray-900 group-hover:text-[#d4af37] transition-colors mb-2">{{ $persona->persona_name }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">{{ $persona->role_summary ?? 'Tidak ada ringkasan peran.' }}</p>
            </a>
            
            <div class="flex items-center justify-between text-xs font-medium text-gray-400 border-t border-gray-50 pt-4 mt-auto">
                <span class="flex items-center uppercase tracking-wider">
                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                    </svg>
                    {{ strtoupper($persona->default_language) }}
                </span>
                <span>{{ $persona->created_at->diffForHumans() }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-200">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-6 text-gray-300">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada persona</h3>
            <p class="text-gray-500 mb-8 max-w-sm mx-auto">Mulai dengan membuat identitas AI pertama Anda untuk mulai mengkonfigurasi asisten cerdas.</p>
            <a href="{{ route('personas.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg shadow-gray-900/10 text-sm font-medium rounded-lg text-white bg-gray-900 hover:bg-black transition-all duration-200">
                <svg class="-ml-1 mr-2 h-5 w-5 text-[#d4af37]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span class="text-[#d4af37]">Buat Persona Baru</span>
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
