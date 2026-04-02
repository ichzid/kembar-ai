@extends('layouts.app')

@section('title', $persona->persona_name)

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-8 gap-4">
        <div class="flex items-start gap-4">
            <a href="{{ route('personas.index') }}" class="flex-shrink-0 w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 hover:text-gray-900 hover:border-gray-300 transition-colors mt-1 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-[32px] font-bold text-gray-900 mb-1 tracking-tight">{{ $persona->persona_name }}</h1>
                <p class="text-[15px] text-gray-500 max-w-2xl leading-relaxed">{{ $persona->role_summary }}</p>
            </div>
        </div>
        <a href="{{ route('personas.edit', $persona) }}" class="flex-shrink-0 px-5 py-2.5 bg-[#8cb400] text-white text-sm font-semibold rounded-xl hover:bg-[#7a9d00] transition-colors flex items-center shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Edit Konfigurasi
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Left Column: Knowledge Base -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Knowledge List -->
            <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-[15px] font-bold text-gray-900">Knowledge Base</h2>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-[#cdda28] text-[#4e5e06] text-xs font-bold">{{ $knowledge->total() }} Items</div>
                </div>
                
                <div class="divide-y divide-gray-100 p-6 space-y-5">
                    @forelse($knowledge as $item)
                    <div class="group relative pt-5 first:pt-0">
                        <div class="flex justify-between items-start gap-4">
                            <div class="space-y-3 flex-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-[#f4f5f7] text-gray-700">
                                    {{ $item->type }}
                                </span>
                                <p class="text-gray-500 whitespace-pre-line text-[14px] leading-relaxed">{{ $item->content }}</p>
                                @if($item->source)
                                <div class="text-[12px] text-gray-400 mt-2 flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    {{ $item->source }}
                                </div>
                                @endif
                            </div>
                            <!-- Delete button (visible on hover) -->
                            <form action="{{ route('personas.knowledge.destroy', [$persona, $item]) }}" method="POST" onsubmit="return confirm('Hapus knowledge ini?');" class="flex-shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50 opacity-0 group-hover:opacity-100 focus:opacity-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 text-center border-2 border-dashed border-gray-100 rounded-xl">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#f4f5f7] mb-4 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="text-gray-900 font-bold mb-1 text-sm">Belum ada knowledge base</h4>
                        <p class="text-xs text-gray-500 max-w-xs mx-auto">Tambahkan informasi spesifik agar persona Anda memiliki konteks yang lebih kaya</p>
                    </div>
                    @endforelse
                </div>
                
                @if($knowledge->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $knowledge->links() }}
                </div>
                @endif
            </div>

            <!-- Add Knowledge Form -->
            <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-[#8cb400]/10 text-[#8cb400] flex items-center justify-center mr-3 font-bold text-lg">
                        +
                    </div>
                    <h2 class="text-[15px] font-bold text-gray-900">Knowledge Base</h2>
                </div>
                
                <form action="{{ route('personas.knowledge.store', $persona) }}" method="POST" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-900 uppercase mb-2">TIPE</label>
                            <div class="relative">
                                <select name="type" class="w-full border border-gray-200 rounded-lg pl-4 pr-10 py-3 text-sm text-gray-600 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none appearance-none bg-white cursor-pointer">
                                    <option value="bio">Bio / Latar Belakang</option>
                                    <option value="experience">Pengalaman</option>
                                    <option value="opinion">Opini / Pendapat</option>
                                    <option value="faq">FAQ (Tanya Jawab)</option>
                                    <option value="story">Cerita</option>
                                    <option value="content">Konten Umum</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-900 uppercase mb-2">SUMBER (Opsional)</label>
                            <input type="text" name="source" class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none" placeholder="Contoh: Training Data, FAQ Database, Case Study">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-gray-900 uppercase mb-2">KONTEN KNOWLEDGE</label>
                        <textarea name="content" rows="4" class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none resize-none" placeholder="Tuliskan informasi yang harus diingat oleh persona..." required></textarea>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-[#8cb400] text-white text-sm font-semibold rounded-xl hover:bg-[#7a9d00] transition-colors flex items-center shadow-sm">
                            <span class="mr-1.5 font-bold text-lg leading-none">+</span>
                            TAMBAH KNOWLEDGE
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Info & Details -->
        <div class="space-y-6">
            <!-- Settings Card -->
            <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 p-6 overflow-hidden">
                <h3 class="font-bold text-gray-900 text-[15px] mb-6 border-b border-gray-100 pb-4">Pengaturan Saat Ini</h3>
                
                <div class="space-y-5">
                    <!-- Bahasa -->
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">BAHASA</label>
                        <div class="w-full bg-[#f8f9fa] border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700">
                            {{ strtoupper($persona->default_language) }}
                        </div>
                    </div>
                    
                    <!-- Verbosity -->
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">VERBOSITY</label>
                        <div class="w-full bg-[#f8f9fa] border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700">
                            {{ ucfirst($persona->settings?->verbosity ?? 'Normal') }}
                        </div>
                    </div>

                    <!-- Tone -->
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">GAYA BICARA</label>
                        <div class="flex flex-wrap gap-2">
                            @forelse($persona->settings?->tone_style ?? [] as $tone)
                                <span class="px-3 py-1 bg-[#cdda28] text-[#4e5e06] text-[11px] font-bold rounded-full">{{ $tone }}</span>
                            @empty
                                <span class="text-xs text-gray-400 italic">Belum diatur</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Target Audiens -->
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">TARGET AUDIENS</label>
                        <div class="flex flex-wrap gap-2">
                            @forelse($persona->settings?->audience_default ?? [] as $audience)
                                <span class="px-3 py-1 bg-[#f4f5f7] text-gray-700 text-[11px] font-bold rounded-full border border-gray-100">{{ $audience }}</span>
                            @empty
                                <span class="text-xs text-gray-400 italic">Belum diatur</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Guardrails -->
                    @if(!empty($persona->settings?->guardrails))
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">GUARDRAILS</label>
                        <div class="bg-red-50 border border-red-100 rounded-lg p-3.5">
                            <ul class="list-disc list-inside space-y-1.5 ml-1">
                                @foreach($persona->settings->guardrails as $rule)
                                    <li class="text-[12px] text-red-600 leading-snug">{{ $rule }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <!-- System Prompt -->
                    <div class="pt-1">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">SYSTEM PROMPT</label>
                        <div class="bg-[#f8f9fa] border border-gray-200 rounded-lg p-4 font-mono text-[12px] text-gray-600 leading-relaxed max-h-[160px] overflow-y-auto">
                            <span class="text-[#ca8a04] font-bold">You are {{ $persona->persona_name }}.</span> {{ $persona->persona_description }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Knowledge Base Tips -->
            <div class="bg-[#f8f9fa] rounded-[20px] shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-gray-900 mb-5 flex items-center text-[15px]">
                    <div class="w-7 h-7 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    Tips Knowledge Base
                </h3>
                
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-1 h-1 rounded-full bg-gray-900 mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-gray-900 text-[13px] mb-0.5">Fokus pada relevansi</strong>
                            <p class="text-gray-500 text-[12px] leading-relaxed">Masukkan informasi yang paling sering ditanyakan atau dibutuhkan oleh audiens Anda.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1 h-1 rounded-full bg-gray-900 mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-gray-900 text-[13px] mb-0.5">Gunakan Format Tanya-Jawab</strong>
                            <p class="text-gray-500 text-[12px] leading-relaxed">Untuk tipe FAQ, tuliskan pertanyaan spesifik dan jawaban yang diharapkan agar AI lebih akurat.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1 h-1 rounded-full bg-gray-900 mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-gray-900 text-[13px] mb-0.5">Perbarui Berkala</strong>
                            <p class="text-gray-500 text-[12px] leading-relaxed">Informasi yang kadaluarsa dapat membingungkan AI. Hapus atau update knowledge yang sudah tidak valid.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
