@extends('layouts.app')

@section('title', 'Buat Persona Baru')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-2">Buat Persona Baru</h1>
        <p class="text-gray-500 text-[14px]">Definisikan karakter, gaya bicara, dan Batasan asisten Ai Anda untuk<br class="hidden sm:block">menciptakan pengalaman interaksi yang unik dan personal</p>
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

    <form action="{{ route('personas.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Section 1: Identitas Utama -->
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#f9fafb] border-b border-gray-200 flex items-center">
                <div class="w-8 h-8 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center text-sm font-bold mr-4">01</div>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-widest">IDENTITAS UTAMA</h2>
            </div>
            
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Persona -->
                    <div>
                        <label for="persona_name" class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Nama Persona <span class="text-red-500">*</span></label>
                        <input type="text" name="persona_name" id="persona_name" 
                            class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none" 
                            placeholder="Contoh: john doe (Customer Service)" 
                            required 
                            value="{{ old('persona_name') }}">
                        @error('persona_name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bahasa Utama -->
                    <div>
                        <label for="default_language" class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Bahasa Utama <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="default_language" id="default_language" 
                                class="w-full border border-gray-200 rounded-lg pl-4 pr-10 py-3 text-sm text-gray-600 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none appearance-none bg-white cursor-pointer">
                                <option value="id" {{ old('default_language') == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="en" {{ old('default_language') == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Peran -->
                <div>
                    <label for="role_summary" class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Ringkasan Peran <span class="text-red-500">*</span></label>
                    <textarea name="role_summary" id="role_summary" rows="3"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none resize-none" 
                        placeholder="Contoh: Asisten virtual yang ramah untuk menjawab pertanyaan produk fashion...">{{ old('role_summary') }}</textarea>
                    <p class="mt-2 text-[12px] text-gray-500">Penjelasan singkat satu kalimat tentang tugas utama persona ini</p>
                </div>
            </div>
        </div>

        <!-- Section 2: Instruksi Sistem -->
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#f9fafb] border-b border-gray-200 flex items-center">
                <div class="w-8 h-8 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center text-sm font-bold mr-4">02</div>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-widest">INSTRUKSI SISTEM</h2>
            </div>
            
            <div class="p-8">
                <div>
                    <label for="persona_description" class="block text-[12px] font-bold text-gray-900 uppercase mb-2">System Prompt</label>
                    <textarea name="persona_description" id="persona_description" rows="8" 
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none font-mono" 
                        placeholder="Anda adalah [Nama], seorang ahli dibidang [Bidang]. Tugas Anda adalah membantu user dengan cara [Gaya Bicara]...">{{ old('persona_description') }}</textarea>
                    
                    <div class="mt-4 flex items-start gap-4 p-5 bg-[#fffbcc] border border-[#fde047] rounded-xl">
                        <div class="text-[#ca8a04] flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 mb-1">Panduan System Prompt</h4>
                            <p class="text-[13px] text-gray-700 leading-relaxed">
                                Ini adalah instruksi inti yang akan membentuk kepribadian AI. Gunakan bahasa yang jelas dan spesifik untuk mendefinisikan batasan, nada bicara, dan pengetahuan dasar. Semakin detail instruksi, semakin akurat respons yang dihasilkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Pengaturan Respons -->
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#f9fafb] border-b border-gray-200 flex items-center">
                <div class="w-8 h-8 rounded-full bg-[#cdda28] text-[#4e5e06] flex items-center justify-center text-sm font-bold mr-4">03</div>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-widest">PENGATURAN RESPONS</h2>
            </div>
            
            <div class="p-8 space-y-6">
                <!-- Verbosity -->
                <div>
                    <label for="verbosity" class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Panjang Respons <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="verbosity" id="verbosity" 
                            class="w-full border border-gray-200 rounded-lg pl-4 pr-10 py-3 text-sm text-gray-600 focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors outline-none appearance-none bg-white cursor-pointer">
                            <option value="short" {{ old('verbosity') == 'short' ? 'selected' : '' }}>Short (Singkat & Padat)</option>
                            <option value="normal" {{ old('verbosity', 'normal') == 'normal' ? 'selected' : '' }}>Normal (Standar)</option>
                            <option value="long" {{ old('verbosity') == 'long' ? 'selected' : '' }}>Long (Detail & Penjelasan Panjang)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Tone Style -->
                    <div id="tone-container">
                        <label class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Gaya Bicara (Tone)</label>
                        <div class="min-h-[46px] w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-900 focus-within:border-[#8cb400] focus-within:ring-1 focus-within:ring-[#8cb400] transition-colors bg-white">
                            <div class="flex flex-wrap gap-2" id="tone-tags"></div>
                            <input type="text" id="tone-input" 
                                class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400 outline-none" 
                                placeholder="Ketik lalu Enter...">
                        </div>
                        <input type="hidden" name="tone_style" id="tone_style_hidden" value="{{ old('tone_style') }}">
                        
                        <div class="mt-4">
                            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-3">REKOMENDASI:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Santai', 'Profesional', 'Religius', 'Inspiratif', 'Tegas', 'Friendly'] as $preset)
                                    <button type="button" onclick="addTag('tone', '{{ $preset }}')" 
                                        class="px-3 py-1.5 rounded-full text-[12px] font-medium bg-white text-gray-600 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                                        {{ $preset }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Audience Default -->
                    <div id="audience-container">
                        <label class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Target Audiens</label>
                        <div class="min-h-[46px] w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-900 focus-within:border-[#8cb400] focus-within:ring-1 focus-within:ring-[#8cb400] transition-colors bg-white">
                            <div class="flex flex-wrap gap-2" id="audience-tags"></div>
                            <input type="text" id="audience-input" 
                                class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400 outline-none" 
                                placeholder="Ketik lalu Enter...">
                        </div>
                        <input type="hidden" name="audience_default" id="audience_default_hidden" value="{{ old('audience_default') }}">
                        
                        <div class="mt-4">
                            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-3">REKOMENDASI:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Fans Umum', 'Murid/Komunitas', 'Profesional/Corporate', 'Brand/Sponsor'] as $preset)
                                    <button type="button" onclick="addTag('audience', '{{ $preset }}')" 
                                        class="px-3 py-1.5 rounded-full text-[12px] font-medium bg-white text-gray-600 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                                        {{ $preset }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guardrails -->
                <div id="guardrails-container">
                    <label class="block text-[12px] font-bold text-gray-900 uppercase mb-2">Batasan Keamanan (Guardrails)</label>
                    <div class="min-h-[46px] w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-900 focus-within:border-[#8cb400] focus-within:ring-1 focus-within:ring-[#8cb400] transition-colors bg-white">
                        <div class="flex flex-wrap gap-2" id="guardrails-tags"></div>
                        <input type="text" id="guardrails-input" 
                            class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400 outline-none" 
                            placeholder="Ketik lalu Enter...">
                    </div>
                    <input type="hidden" name="guardrails" id="guardrails_hidden" value="{{ old('guardrails') }}">
                    
                    <div class="mt-4">
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-3">REKOMENDASI:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Kekerasan & Kejahatan', 'Pornografi & Eksploitasi Seksual', 'Narkoba & Zat Terlarang', 'Penipuan & Kejahatan Finansial'] as $preset)
                                <button type="button" onclick="addTag('guardrails', '{{ $preset }}')" 
                                    class="px-3 py-1.5 rounded-full text-[12px] font-medium bg-white text-gray-600 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                                    {{ $preset }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row items-center justify-end gap-4 pt-4 pb-8">
            <a href="{{ route('personas.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-gray-900 transition-all">
                Batal
            </a>
            <button type="submit" class="w-full md:w-auto px-8 py-2.5 bg-[#8cb400] text-white text-sm font-semibold rounded-xl hover:bg-[#7a9d00] shadow-sm transition-all duration-300">
                Simpan Persona
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const tagState = { tone: [], audience: [], guardrails: [] };
    const tagConfig = {
        tone: { separator: ',', hiddenId: 'tone_style_hidden', inputId: 'tone-input', tagsId: 'tone-tags' },
        audience: { separator: ',', hiddenId: 'audience_default_hidden', inputId: 'audience-input', tagsId: 'audience-tags' },
        guardrails: { separator: '\n', hiddenId: 'guardrails_hidden', inputId: 'guardrails-input', tagsId: 'guardrails-tags' }
    };

    document.addEventListener('DOMContentLoaded', function() {
        ['tone', 'audience', 'guardrails'].forEach(type => {
            const hiddenInput = document.getElementById(tagConfig[type].hiddenId);
            if (hiddenInput && hiddenInput.value) {
                tagState[type] = hiddenInput.value.split(tagConfig[type].separator).map(t => t.trim()).filter(t => t);
                renderTags(type);
            }

            const inputElement = document.getElementById(tagConfig[type].inputId);
            if (inputElement) {
                inputElement.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const value = this.value.trim();
                        if (value) { addTag(type, value); this.value = ''; }
                    } else if (e.key === 'Backspace' && !this.value && tagState[type].length > 0) {
                        removeTag(type, tagState[type].length - 1);
                    }
                });
                
                inputElement.addEventListener('blur', function() {
                     const value = this.value.trim();
                     if (value) { addTag(type, value); this.value = ''; }
                });
            }
        });
    });

    window.addTag = function(type, value) {
        if (!tagState[type].includes(value)) {
            tagState[type].push(value);
            renderTags(type);
            updateHiddenInput(type);
        }
        document.getElementById(tagConfig[type].inputId)?.focus();
    };

    window.removeTag = function(type, index) {
        tagState[type].splice(index, 1);
        renderTags(type);
        updateHiddenInput(type);
    };

    function renderTags(type) {
        const container = document.getElementById(tagConfig[type].tagsId);
        if (!container) return;
        container.innerHTML = '';
        tagState[type].forEach((tag, index) => {
            const tagEl = document.createElement('div');
            tagEl.className = 'inline-flex items-center bg-[#f4f5f7] text-gray-700 border border-gray-200 rounded-md px-2 py-1 text-[13px]';
            tagEl.innerHTML = `
                <span>${tag}</span>
                <button type="button" onclick="removeTag('${type}', ${index})" class="ml-1.5 hover:text-red-500 focus:outline-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;
            container.appendChild(tagEl);
        });
    }

    function updateHiddenInput(type) {
        const hiddenInput = document.getElementById(tagConfig[type].hiddenId);
        if (hiddenInput) {
            hiddenInput.value = tagState[type].join(tagConfig[type].separator);
        }
    }
</script>
@endpush
