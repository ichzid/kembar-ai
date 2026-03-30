@extends('layouts.app')

@section('title', 'Buat Persona Baru')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-4 font-display">Buat Persona Baru</h1>
        <p class="text-gray-500 text-lg font-light max-w-2xl mx-auto leading-relaxed">Definisikan karakter, gaya bicara, dan batasan asisten AI Anda untuk menciptakan pengalaman interaksi yang unik dan personal.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8">
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
    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8">
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

    <form action="{{ route('personas.store') }}" method="POST" class="space-y-10">
        @csrf

        <!-- Section 1: Identitas Utama -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden hover:shadow-md transition-all duration-300">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 backdrop-blur-sm">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center tracking-wide">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 text-[#d4af37] text-xs font-bold mr-4 shadow-sm ring-2 ring-gray-100">01</span>
                    IDENTITAS UTAMA
                </h2>
            </div>
            
            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Persona -->
                    <div class="group">
                        <label for="persona_name" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Nama Persona <span class="text-red-400">*</span></label>
                        <input type="text" name="persona_name" id="persona_name" 
                            class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50" 
                            placeholder="Contoh: Sarah (Customer Support)" 
                            required 
                            value="{{ old('persona_name') }}">
                        @error('persona_name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bahasa Utama -->
                    <div class="group">
                        <label for="default_language" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Bahasa Utama <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <select name="default_language" id="default_language" 
                                class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm appearance-none shadow-sm hover:bg-gray-50">
                                <option value="id" {{ old('default_language') == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="en" {{ old('default_language') == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Peran -->
                <div class="group">
                    <label for="role_summary" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Ringkasan Peran</label>
                    <input type="text" name="role_summary" id="role_summary" 
                        class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50" 
                        placeholder="Contoh: Asisten virtual yang ramah untuk menjawab pertanyaan produk fashion" 
                        value="{{ old('role_summary') }}">
                    <p class="mt-2 text-xs text-gray-400 font-medium">Penjelasan singkat satu kalimat tentang tugas utama persona ini.</p>
                </div>
            </div>
        </div>

        <!-- Section 2: Instruksi Sistem -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden hover:shadow-md transition-all duration-300">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 backdrop-blur-sm">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center tracking-wide">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 text-[#d4af37] text-xs font-bold mr-4 shadow-sm ring-2 ring-gray-100">02</span>
                    INSTRUKSI SISTEM
                </h2>
            </div>
            
            <div class="p-8 space-y-8">
                <div class="group">
                    <div class="flex items-center justify-between mb-3">
                        <label for="persona_description" class="block text-xs font-bold text-gray-500 uppercase tracking-widest group-focus-within:text-[#d4af37] transition-colors">System Prompt</label>
                        <span class="text-[10px] font-bold tracking-wider text-[#d4af37] bg-[#d4af37]/10 px-3 py-1 rounded-full uppercase">Core Instruction</span>
                    </div>
                    <div class="relative">
                        <textarea name="persona_description" id="persona_description" rows="12" 
                            class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm font-mono leading-relaxed shadow-sm hover:bg-gray-50" 
                            placeholder="Anda adalah [Nama], seorang ahli di bidang [Bidang]. Tugas Anda adalah membantu user dengan cara [Gaya Bicara]...">{{ old('persona_description') }}</textarea>
                    </div>
                    <div class="mt-4 flex items-start gap-4 p-5 bg-[#d4af37]/5 rounded-xl border border-[#d4af37]/20">
                        <div class="bg-[#d4af37]/10 p-2 rounded-lg text-[#d4af37]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">Panduan System Prompt</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Ini adalah instruksi inti yang akan membentuk kepribadian AI. Gunakan bahasa yang jelas dan spesifik untuk mendefinisikan batasan, nada bicara, dan pengetahuan dasar. Semakin detail instruksi, semakin akurat respons yang dihasilkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Pengaturan Respons -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden hover:shadow-md transition-all duration-300">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 backdrop-blur-sm">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center tracking-wide">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 text-[#d4af37] text-xs font-bold mr-4 shadow-sm ring-2 ring-gray-100">03</span>
                    PENGATURAN RESPONS
                </h2>
            </div>
            
            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Verbosity -->
                    <div class="group md:col-span-2">
                        <label for="verbosity" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Panjang Respons</label>
                        <div class="relative">
                            <select name="verbosity" id="verbosity" 
                                class="block w-full rounded-xl border-gray-200 bg-gray-50/30 px-4 py-3.5 text-gray-900 focus:border-[#d4af37] focus:bg-white focus:ring-4 focus:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm appearance-none shadow-sm hover:bg-gray-50">
                                <option value="short" {{ old('verbosity') == 'short' ? 'selected' : '' }}>Short (Singkat & Padat)</option>
                                <option value="normal" {{ old('verbosity', 'normal') == 'normal' ? 'selected' : '' }}>Normal (Standar)</option>
                                <option value="long" {{ old('verbosity') == 'long' ? 'selected' : '' }}>Long (Detail & Penjelasan Panjang)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tone Style -->
                    <div class="group" id="tone-container">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Gaya Bicara (Tone)</label>
                        <div class="min-h-[52px] block w-full rounded-xl border border-gray-200 bg-gray-50/30 px-3 py-2.5 text-gray-900 focus-within:border-[#d4af37] focus-within:bg-white focus-within:ring-4 focus-within:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50">
                            <div class="flex flex-wrap gap-2" id="tone-tags"></div>
                            <input type="text" id="tone-input" 
                                class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400" 
                                placeholder="Ketik lalu Enter...">
                        </div>
                        <input type="hidden" name="tone_style" id="tone_style_hidden" value="{{ old('tone_style') }}">
                        
                        <div class="mt-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2.5">Rekomendasi:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Santai', 'Profesional', 'Religius', 'Inspiratif', 'Tegas', 'Friendly'] as $preset)
                                    <button type="button" onclick="addTag('tone', '{{ $preset }}')" 
                                        class="px-3.5 py-1.5 rounded-full text-xs font-medium bg-white text-gray-600 hover:bg-gray-900 hover:text-[#d4af37] border border-gray-200 transition-all duration-200 shadow-sm hover:shadow-md hover:border-gray-900">
                                        {{ $preset }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Audience Default -->
                    <div class="group" id="audience-container">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Target Audiens</label>
                        <div class="min-h-[52px] block w-full rounded-xl border border-gray-200 bg-gray-50/30 px-3 py-2.5 text-gray-900 focus-within:border-[#d4af37] focus-within:bg-white focus-within:ring-4 focus-within:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50">
                            <div class="flex flex-wrap gap-2" id="audience-tags"></div>
                            <input type="text" id="audience-input" 
                                class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400" 
                                placeholder="Ketik lalu Enter...">
                        </div>
                        <input type="hidden" name="audience_default" id="audience_default_hidden" value="{{ old('audience_default') }}">
                        
                        <div class="mt-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2.5">Rekomendasi:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Fans Umum', 'Murid / Komunitas', 'Profesional / Corporate', 'Brand / Sponsor'] as $preset)
                                    <button type="button" onclick="addTag('audience', '{{ $preset }}')" 
                                        class="px-3.5 py-1.5 rounded-full text-xs font-medium bg-white text-gray-600 hover:bg-gray-900 hover:text-[#d4af37] border border-gray-200 transition-all duration-200 shadow-sm hover:shadow-md hover:border-gray-900">
                                        {{ $preset }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guardrails -->
                <div class="group" id="guardrails-container">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 group-focus-within:text-[#d4af37] transition-colors">Batasan Keamanan (Guardrails)</label>
                    <div class="min-h-[52px] block w-full rounded-xl border border-gray-200 bg-gray-50/30 px-3 py-2.5 text-gray-900 focus-within:border-[#d4af37] focus-within:bg-white focus-within:ring-4 focus-within:ring-[#d4af37]/10 transition-all duration-200 sm:text-sm shadow-sm hover:bg-gray-50">
                        <div class="flex flex-wrap gap-2" id="guardrails-tags"></div>
                        <input type="text" id="guardrails-input" 
                            class="flex-1 bg-transparent border-none focus:ring-0 p-1 min-w-[150px] text-sm placeholder-gray-400" 
                            placeholder="Ketik lalu Enter...">
                    </div>
                    <input type="hidden" name="guardrails" id="guardrails_hidden" value="{{ old('guardrails') }}">
                    
                    <div class="mt-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2.5">Rekomendasi:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Kekerasan & Kejahatan', 'Pornografi & Eksploitasi Seksual', 'Narkoba & Zat Terlarang', 'Penipuan & Kejahatan Finansial'] as $preset)
                                <button type="button" onclick="addTag('guardrails', '{{ $preset }}')" 
                                    class="px-3.5 py-1.5 rounded-full text-xs font-medium bg-white text-gray-600 hover:bg-gray-900 hover:text-[#d4af37] border border-gray-200 transition-all duration-200 shadow-sm hover:shadow-md hover:border-gray-900">
                                    {{ $preset }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('personas.index') }}" class="px-6 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-gray-900 text-[#d4af37] text-sm font-bold rounded-xl shadow-lg shadow-gray-900/20 hover:bg-black hover:shadow-xl hover:shadow-gray-900/30 hover:-translate-y-0.5 transition-all duration-300 flex items-center border border-gray-800">
                <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                SIMPAN PERSONA
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // State management for tags
    const tagState = {
        tone: [],
        audience: [],
        guardrails: []
    };

    // Configuration for each type
    const tagConfig = {
        tone: { separator: ',', hiddenId: 'tone_style_hidden', inputId: 'tone-input', tagsId: 'tone-tags' },
        audience: { separator: ',', hiddenId: 'audience_default_hidden', inputId: 'audience-input', tagsId: 'audience-tags' },
        guardrails: { separator: '\n', hiddenId: 'guardrails_hidden', inputId: 'guardrails-input', tagsId: 'guardrails-tags' }
    };

    // Initialize tags
    document.addEventListener('DOMContentLoaded', function() {
        ['tone', 'audience', 'guardrails'].forEach(type => {
            const hiddenInput = document.getElementById(tagConfig[type].hiddenId);
            if (hiddenInput && hiddenInput.value) {
                // Split based on separator, trim, and filter empty
                const initialTags = hiddenInput.value.split(tagConfig[type].separator)
                    .map(t => t.trim())
                    .filter(t => t);
                tagState[type] = initialTags;
                renderTags(type);
            }

            // Setup input event listener
            const inputElement = document.getElementById(tagConfig[type].inputId);
            if (inputElement) {
                inputElement.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const value = this.value.trim();
                        if (value) {
                            addTag(type, value);
                            this.value = '';
                        }
                    } else if (e.key === 'Backspace' && !this.value) {
                        // Remove last tag if backspace pressed on empty input
                        if (tagState[type].length > 0) {
                            removeTag(type, tagState[type].length - 1);
                        }
                    }
                });
                
                // Also add on blur/focus out
                inputElement.addEventListener('blur', function() {
                     const value = this.value.trim();
                        if (value) {
                            addTag(type, value);
                            this.value = '';
                        }
                });
            }
        });
    });

    // Add tag function (exposed globally for preset buttons)
    window.addTag = function(type, value) {
        // Prevent duplicates
        if (!tagState[type].includes(value)) {
            tagState[type].push(value);
            renderTags(type);
            updateHiddenInput(type);
        }
        // Focus back to input
        document.getElementById(tagConfig[type].inputId)?.focus();
    };

    // Remove tag function
    window.removeTag = function(type, index) {
        tagState[type].splice(index, 1);
        renderTags(type);
        updateHiddenInput(type);
    };

    // Render tags to DOM
    function renderTags(type) {
        const container = document.getElementById(tagConfig[type].tagsId);
        if (!container) return;

        container.innerHTML = '';
        tagState[type].forEach((tag, index) => {
            const tagElement = document.createElement('div');
            tagElement.className = 'inline-flex items-center bg-[#d4af37]/10 text-[#d4af37] border border-[#d4af37]/20 rounded px-2 py-1 text-xs font-medium';
            tagElement.innerHTML = `
                <span>${tag}</span>
                <button type="button" onclick="removeTag('${type}', ${index})" class="ml-1.5 hover:text-[#b5952f] focus:outline-none">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            container.appendChild(tagElement);
        });
    }

    // Update hidden input value
    function updateHiddenInput(type) {
        const hiddenInput = document.getElementById(tagConfig[type].hiddenId);
        if (hiddenInput) {
            hiddenInput.value = tagState[type].join(tagConfig[type].separator);
        }
    }
</script>
@endpush
