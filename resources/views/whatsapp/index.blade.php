@extends('layouts.app')

@section('title', 'WhatsApp Connections')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight">WhatsApp</h1>
            <p class="text-gray-500 text-base md:text-lg font-light">Kelola koneksi dan integrasi WhatsApp Anda.</p>
        </div>
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

    @if(!$persona)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Anda belum memiliki Persona. Silakan <a href="{{ route('personas.create') }}" class="font-medium underline hover:text-yellow-600">buat Persona</a> terlebih dahulu sebelum menghubungkan WhatsApp.
                    </p>
                </div>
            </div>
        </div>
    @elseif($whatsappAccount)
        <!-- Active Connection -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 4.876 1.213 5.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $whatsappAccount->phone_number }}</h3>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 uppercase tracking-wide">
                                    {{ $whatsappAccount->status }}
                                </span>
                                <span class="text-sm text-gray-500">• {{ $whatsappAccount->provider }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Terhubung dengan Persona: <span class="font-medium text-gray-900">{{ $persona->persona_name }}</span></p>
                        </div>
                    </div>
                    
                    <form action="{{ route('whatsapp.destroy', $whatsappAccount) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memutuskan koneksi WhatsApp ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 border border-red-200 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-300 transition-all duration-200">
                            Putuskan Koneksi
                        </button>
                    </form>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <span class="block text-sm text-gray-500 mb-1">Terakhir Aktif</span>
                        <span class="block text-lg font-medium text-gray-900">{{ $whatsappAccount->last_connected_at ? $whatsappAccount->last_connected_at->diffForHumans() : '-' }}</span>
                    </div>
                    <!-- Add more stats if needed -->
                </div>
            </div>
        </div>
    @else
        <!-- Connect Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 backdrop-blur-sm">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center tracking-wide">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 text-[#d4af37] text-xs font-bold mr-4 shadow-sm ring-2 ring-gray-100">01</span>
                    SETUP QISCUS
                </h2>
            </div>

            <div class="p-8">
                <div class="max-w-xl mx-auto mb-8 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#d4af37]/10 mb-4 text-[#d4af37]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Hubungkan WhatsApp</h2>
                    <p class="text-gray-500 mt-2">Masukkan kredensial Qiscus Omnichannel untuk menghubungkan nomor WhatsApp Anda dengan persona <strong>{{ $persona->persona_name }}</strong>.</p>
                </div>

                <form action="{{ route('whatsapp.store') }}" method="POST" class="space-y-8 max-w-2xl mx-auto">
                    @csrf
                    
                    <!-- Hidden Provider Field -->
                    <input type="hidden" name="provider" value="qiscus">

                    <!-- Qiscus Instructions -->
                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 flex items-start gap-4">
                        <div class="text-blue-500 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-blue-800 font-bold text-sm mb-2 uppercase tracking-wide">Panduan Integrasi</h4>
                            <p class="text-blue-700 text-sm leading-relaxed">
                                1. Login ke <a href="https://multichannel.qiscus.com/" target="_blank" class="underline font-semibold hover:text-blue-900">Qiscus Omnichannel</a><br>
                                2. Masuk ke <strong>Settings > App Information</strong><br>
                                3. Salin <strong>App Code</strong> dan <strong>Secret Key</strong> ke form di bawah ini.
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="group">
                            <label for="provider_app_id" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">App ID<span class="text-red-400">*</span></label>
                            <input type="text" name="provider_app_id" id="provider_app_id" placeholder="Contoh: myapp-123" class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50" required>
                        </div>
                        
                        <div class="group">
                            <label for="provider_secret_key" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Qiscus Secret Key<span class="text-red-400">*</span></label>
                            <input type="password" name="provider_secret_key" id="provider_secret_key" placeholder="Masukkan Secret Key jika dibutuhkan" class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50" required>
                        </div>

                        <div class="group">
                            <label for="phone_number" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Nomor WhatsApp <span class="text-red-400">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Contoh: 6281234567890" class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50" required>
                            <p class="mt-2 text-xs text-gray-400 font-medium">Gunakan format internasional (dimulai dengan kode negara, misal 62 untuk Indonesia).</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-sm font-bold text-[#d4af37] bg-gray-900 hover:bg-black focus:outline-none focus:ring-4 focus:ring-gray-900/30 transition-all duration-300 uppercase tracking-widest border border-gray-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Hubungkan Sekarang
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
