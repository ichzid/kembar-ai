@extends('layouts.app')

@section('title', 'WhatsApp Connections')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="mb-10 text-left">
        <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-2">WhatsApp</h1>
        <p class="text-gray-500 text-[14px]">Kelola koneksi dan integrasi WhatsApp Anda.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 text-green-700 px-4 py-3 rounded-xl text-sm border border-green-100 flex items-center mb-8">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif 

    @if(session('error'))
    <div class="bg-red-50 text-red-700 px-4 py-3 rounded-xl text-sm border border-red-100 flex items-center mb-8">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        {{ session('error') }}
    </div>
    @endif

    @if(!$persona)
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded-xl text-sm border border-yellow-100 flex items-start mb-8">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <p>Anda belum memiliki Persona. Silakan <a href="{{ route('personas.create') }}" class="font-bold underline hover:text-yellow-800">buat Persona</a> terlebih dahulu sebelum menghubungkan WhatsApp.</p>
            </div>
        </div>
    @elseif($whatsappAccount)
        <!-- Active Connection -->
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden p-8">
            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                <!-- Info -->
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 rounded-full bg-[#ebf8ed] flex items-center justify-center text-[#25d366] flex-shrink-0">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 4.876 1.213 5.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 leading-none">{{ $whatsappAccount->phone_number }}</h3>
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-3 py-1 bg-[#e6f4ea] text-green-700 text-[11px] font-bold rounded-full uppercase tracking-wide">
                                {{ $whatsappAccount->status == 'connected' ? 'Connected' : $whatsappAccount->status }}
                            </span>
                            <span class="text-[13px] text-gray-500 font-medium">• {{ strtolower($whatsappAccount->provider) }}</span>
                        </div>
                        <p class="text-[13px] text-gray-500 mt-2">Terhubung dengan persona: <strong class="text-gray-900 font-semibold">{{ $persona->persona_name }}</strong></p>
                    </div>
                </div>

                <!-- Action Button -->
                <form action="{{ route('whatsapp.destroy', $whatsappAccount) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memutuskan koneksi WhatsApp ini?');" class="md:self-start">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 border border-red-200 text-red-500 text-[13px] font-semibold rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors w-full md:w-auto">
                        Putuskan Koneksi
                    </button>
                </form>
            </div>

            <div class="mt-6 inline-block">
                <div class="bg-[#f8f9fa] rounded-xl px-4 py-3 pr-12">
                    <span class="block text-[12px] font-semibold text-gray-400 mb-0.5">Terlihat aktif</span>
                    <span class="block text-[14px] font-bold text-gray-800">{{ $whatsappAccount->last_connected_at ? $whatsappAccount->last_connected_at->diffForHumans() : '-' }}</span>
                </div>
            </div>
        </div>
    @else
        <!-- Connect Form -->
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#f9fafb] border-b border-gray-200 flex items-center">
                <div class="w-8 h-8 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center text-sm font-bold mr-4 shrink-0">01</div>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-widest">SETUP QISCUS</h2>
            </div>

            <div class="p-8">
                <div class="max-w-xl mx-auto mb-8 text-center mt-2">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#eef8f0] mb-5 text-[#25d366]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Hubungkan WhatsApp</h2>
                    <p class="text-gray-500 text-[14px]">Masukan kredensial Qiscus Omnichannel untuk menghubungkan nomor<br class="hidden sm:block">WhatsApp anda dengan persona <strong class="text-gray-900">{{ $persona->persona_name }}</strong></p>
                </div>

                <form action="{{ route('whatsapp.store') }}" method="POST" class="space-y-6 max-w-[500px] mx-auto mb-8">
                    @csrf
                    
                    <!-- Hidden Provider Field -->
                    <input type="hidden" name="provider" value="qiscus">

                    <!-- Qiscus Instructions -->
                    <div class="bg-blue-50/50 p-5 rounded-xl border border-blue-200 flex items-start gap-3 mb-8">
                        <div class="text-blue-500 shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0-4h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-blue-600 font-bold text-sm mb-1.5 uppercase tracking-wide">PANDUAN INTEGRASI</h4>
                            <p class="text-blue-500 text-[13px] leading-relaxed">
                                1. Login ke <a href="https://multichannel.qiscus.com/" target="_blank" class="font-bold underline hover:text-blue-700">Qiscus Omnichannel</a><br>
                                2. Masuk ke <strong class="font-bold">settings > App Information</strong><br>
                                3. Salin <strong class="font-bold">App Code</strong> dan <strong class="font-bold">Secret Key</strong> ke form di bawah ini
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label for="provider_app_id" class="block text-[12px] font-bold text-gray-800 uppercase mb-2">APP ID<span class="text-red-500">*</span></label>
                            <input type="text" name="provider_app_id" id="provider_app_id" placeholder="Contoh: myapp-123" 
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none" required>
                        </div>
                        
                        <div>
                            <label for="provider_secret_key" class="block text-[12px] font-bold text-gray-800 uppercase mb-2">QISCUS SECRET KEY<span class="text-red-500">*</span></label>
                            <input type="password" name="provider_secret_key" id="provider_secret_key" placeholder="Masukan secret key jika dibutuhkan" 
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none" required>
                        </div>

                        <div>
                            <label for="phone_number" class="block text-[12px] font-bold text-gray-800 uppercase mb-2">WHATSAPP NUMBER<span class="text-red-500">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="08xxxxxxxxxxxx" 
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none" required>
                            <p class="mt-2 text-[12px] text-gray-500">Gunakan format internasional (dimulai dengan kode negara, misal 62<br>untuk indonesia).</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-6 rounded-lg text-[13px] font-bold text-white bg-[#8cb400] hover:bg-[#7a9d00] shadow-sm transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
			                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            Hubungkan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
