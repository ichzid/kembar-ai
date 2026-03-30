@extends('layouts.app')

@section('title', $persona->persona_name)

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <div class="flex items-center gap-4 mb-3">
                <a href="{{ route('personas.index') }}" class="group flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 shadow-sm text-gray-400 hover:text-gray-900 hover:border-gray-300 transition-all">
                    <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h1 class="text-4xl font-bold font-display text-gray-900 tracking-tight">{{ $persona->persona_name }}</h1>
            </div>
            <p class="text-gray-500 text-lg font-light ml-14 max-w-2xl leading-relaxed">{{ $persona->role_summary }}</p>
        </div>
        <div class="flex gap-3 ml-14 md:ml-0">
            <a href="{{ route('personas.edit', $persona) }}" class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-xl shadow-sm hover:bg-gray-50 hover:text-gray-900 hover:border-gray-300 transition-all duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Konfigurasi
            </a>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Knowledge Base -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Knowledge List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden transition-all hover:shadow-md duration-300">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 backdrop-blur-sm">
                    <h3 class="font-bold text-gray-900 flex items-center text-lg tracking-tight">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-900 text-[#d4af37] mr-3 ring-4 ring-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </span>
                        Knowledge Base
                    </h3>
                    <span class="text-xs font-bold bg-gray-900 text-[#d4af37] px-3 py-1 rounded-full shadow-sm">{{ $knowledge->total() }} Items</span>
                </div>
                
                <div class="divide-y divide-gray-50">
                    @forelse($knowledge as $item)
                    <div class="p-6 hover:bg-gray-50/50 transition-colors group">
                        <div class="flex justify-between items-start gap-4">
                            <div class="space-y-3 flex-1">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-gray-50 text-gray-700 border border-gray-200">
                                    {{ ucfirst($item->type) }}
                                </span>
                                <p class="text-gray-800 whitespace-pre-line text-sm leading-relaxed font-light">{{ Str::limit($item->content, 200) }}</p>
                                @if($item->source)
                                <div class="flex items-center text-xs text-gray-400 mt-2 bg-gray-50 inline-block px-2 py-1 rounded border border-gray-100">
                                    <svg class="w-3 h-3 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    {{ $item->source }}
                                </div>
                                @endif
                            </div>
                            <form action="{{ route('personas.knowledge.destroy', [$persona, $item]) }}" method="POST" onsubmit="return confirm('Hapus knowledge ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-red-50 opacity-0 group-hover:opacity-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-6 text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="text-gray-900 font-bold mb-2">Belum ada knowledge base</h4>
                        <p class="text-sm text-gray-500 max-w-xs mx-auto">Tambahkan informasi spesifik agar persona Anda memiliki konteks yang lebih kaya.</p>
                    </div>
                    @endforelse
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $knowledge->links() }}
                </div>
            </div>

            <!-- Add Knowledge Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden transition-all hover:shadow-md duration-300">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 backdrop-blur-sm">
                    <h3 class="font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Knowledge Baru
                    </h3>
                </div>
                <form action="{{ route('personas.knowledge.store', $persona) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1 group">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 group-focus-within:text-[#d4af37] transition-colors">Tipe</label>
                            <div class="relative">
                                <select name="type" class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-[#d4af37] focus:ring-4 focus:ring-[#d4af37]/20 transition-all duration-200 sm:text-sm appearance-none shadow-sm hover:border-[#d4af37]/50">
                                    <option value="bio">Bio / Latar Belakang</option>
                                    <option value="experience">Pengalaman</option>
                                    <option value="opinion">Opini / Pendapat</option>
                                    <option value="faq">FAQ (Tanya Jawab)</option>
                                    <option value="story">Cerita</option>
                                    <option value="content">Konten Umum</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2 group">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 group-focus-within:text-[#d4af37] transition-colors">Sumber (Opsional)</label>
                            <input type="text" name="source" class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:ring-4 focus:ring-[#d4af37]/20 transition-all duration-200 sm:text-sm shadow-sm hover:border-[#d4af37]/50" placeholder="Contoh: Training Data, FAQ Database, Case Study">
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 group-focus-within:text-[#d4af37] transition-colors">Konten Knowledge</label>
                        <textarea name="content" rows="4" class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-[#d4af37] focus:ring-4 focus:ring-[#d4af37]/20 transition-all duration-200 sm:text-sm shadow-sm hover:border-[#d4af37]/50" placeholder="Tuliskan informasi yang harus diingat oleh persona..." required></textarea>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 bg-gray-900 text-[#d4af37] text-sm font-bold rounded-xl shadow-lg shadow-gray-900/20 hover:bg-black hover:shadow-xl hover:shadow-gray-900/30 transition-all duration-300 flex items-center border border-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            TAMBAH KNOWLEDGE
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Info & Details -->
        <div class="space-y-8">
            <!-- Settings Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden p-6 hover:shadow-md transition-all duration-300">
                <h3 class="font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center tracking-tight">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#d4af37] mr-3 ring-4 ring-[#d4af37]/20 shadow-sm"></span>
                    Pengaturan Saat Ini
                </h3>
                <dl class="space-y-6">
                    <div>
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Bahasa</dt>
                        <dd class="font-medium text-gray-900 text-sm flex items-center bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                            {{ strtoupper($persona->default_language) }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Verbosity</dt>
                        <dd class="font-medium text-gray-900 text-sm flex items-center bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            {{ ucfirst($persona->settings?->verbosity ?? 'Normal') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Gaya Bicara</dt>
                        <dd class="flex flex-wrap gap-2">
                            @forelse($persona->settings?->tone_style ?? [] as $tone)
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-gray-900 text-[#d4af37] border border-gray-800 shadow-sm">{{ $tone }}</span>
                            @empty
                                <span class="text-sm text-gray-400 italic">Belum diatur</span>
                            @endforelse
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Target Audiens</dt>
                        <dd class="flex flex-wrap gap-2">
                            @forelse($persona->settings?->audience_default ?? [] as $audience)
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">{{ $audience }}</span>
                            @empty
                                <span class="text-sm text-gray-400 italic">Belum diatur</span>
                            @endforelse
                        </dd>
                    </div>

                    @if(!empty($persona->settings?->guardrails))
                    <div>
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Guardrails</dt>
                        <dd class="bg-red-50/50 rounded-xl p-4 border border-red-100">
                            <ul class="list-disc list-outside ml-4 space-y-1">
                                @foreach($persona->settings->guardrails as $rule)
                                    <li class="text-xs text-red-800/80 leading-relaxed font-medium">{{ $rule }}</li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                    @endif

                    <div class="pt-2">
                        <dt class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">System Prompt Preview</dt>
                        <dd class="bg-gray-50 p-4 rounded-xl text-xs text-gray-600 font-mono border border-gray-200 leading-relaxed shadow-inner">
                            <span class="text-[#d4af37] font-bold">You are {{ $persona->persona_name }}.</span> {{ Str::limit($persona->persona_description, 100) }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Knowledge Base Tips -->
            <div class="bg-zinc-900 rounded-2xl shadow-xl shadow-zinc-900/20 p-8 text-white overflow-hidden relative group border border-zinc-800">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-[#d4af37] opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity duration-700"></div>
                
                <h3 class="font-bold text-[#d4af37] mb-6 flex items-center text-lg tracking-tight">
                    <div class="w-8 h-8 rounded-lg bg-[#d4af37]/10 flex items-center justify-center mr-3 border border-[#d4af37]/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    Tips Knowledge Base
                </h3>
                
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#d4af37] mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-white text-sm mb-1">Fokus pada Relevansi</strong>
                            <p class="text-gray-400 text-xs leading-relaxed">Masukkan informasi yang paling sering ditanyakan atau dibutuhkan oleh audiens Anda.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#d4af37] mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-white text-sm mb-1">Gunakan Format Tanya-Jawab</strong>
                            <p class="text-gray-400 text-xs leading-relaxed">Untuk tipe FAQ, tuliskan pertanyaan spesifik dan jawaban yang diharapkan agar AI lebih akurat.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#d4af37] mt-2 flex-shrink-0"></span>
                        <div>
                            <strong class="block text-white text-sm mb-1">Perbarui Berkala</strong>
                            <p class="text-gray-400 text-xs leading-relaxed">Informasi yang kadaluarsa dapat membingungkan AI. Hapus atau update knowledge yang sudah tidak valid.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
