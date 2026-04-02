@extends('layouts.app')

@section('title', 'Decision Inbox')

@section('content')
<div class="w-full space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp

    <!-- Header & Tabs -->
    <div class="flex flex-col xl:flex-row justify-between items-start xl:items-end gap-6 mb-8">
        <div>
            <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-2">Dicision Inbox</h1>
            <p class="text-gray-500 text-[14px]">Tinjau dan putuskan tindakan yang dieskalasi oleh Ai.</p>
        </div>
        <div class="w-full xl:w-auto overflow-x-auto pb-2 xl:pb-0">
            <div class="inline-flex items-center gap-1 bg-gray-50 p-1.5 rounded-xl border border-gray-100 min-w-max">
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'needs_review']) }}" 
                   class="px-5 py-2.5 text-[14px] font-bold rounded-lg transition-all {{ $status === 'needs_review' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    Perlu Review
                </a>
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'interested']) }}" 
                   class="px-5 py-2.5 text-[14px] font-bold rounded-lg transition-all {{ $status === 'interested' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    Tertarik
                </a>
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'ignore']) }}" 
                   class="px-5 py-2.5 text-[14px] font-bold rounded-lg transition-all {{ $status === 'ignore' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    Diabaikan
                </a>
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'review_later']) }}" 
                   class="px-5 py-2.5 text-[14px] font-bold rounded-lg transition-all {{ $status === 'review_later' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    Tinjau Nanti
                </a>
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'all']) }}" 
                   class="px-5 py-2.5 text-[14px] font-bold rounded-lg transition-all {{ $status === 'all' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    Semua
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-[#eef8f0] border-l-4 border-[#8cb400] p-4 mb-8 rounded-r-xl">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-[#8cb400]" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="ml-3 text-sm font-bold text-[#6a8900]">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if($leadsDisabled)
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded-xl text-sm border border-yellow-100 flex items-start mb-8">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <p class="font-bold">Leads & CRM dalam keadaan nonaktif.</p>
                <p class="mt-1 font-medium">Aktifkan toggle Leads & CRM di Pengaturan Akun untuk mengaktifkan fitur Leads, Chat Logs, dan Decision Inbox.</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden {{ $leadsDisabled ? 'opacity-60' : '' }}">
        <!-- Inner Header -->
        <div class="px-6 py-5 border-b border-gray-100 bg-[#fbfcfc] flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-[17px] font-bold text-gray-800">
                @if($status === 'needs_review') Perlu Persetujuan
                @elseif($status === 'interested') Tertarik
                @elseif($status === 'ignore') Diabaikan
                @elseif($status === 'review_later') Tinjau Nanti
                @else Semua Keputusan
                @endif
            </h3>
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.export', ['status' => $status]) }}" 
                class="flex items-center justify-center px-5 py-2.5 bg-[#8cb400] text-white text-[13px] font-bold rounded-xl hover:bg-[#7a9d00] transition-colors shadow-sm gap-2 w-full md:w-auto shrink-0 {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                </svg>
                Export CSV
            </a>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($decisions as $decision)
            <div class="p-6 hover:bg-gray-50/30 transition-colors">
                <div class="flex flex-col gap-3">
                    
                    <!-- Metadata Row -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded bg-[#fdf8d9] text-[#a18116] text-[11px] font-bold tracking-wide uppercase">
                                {{ $decision->detected_intent ?? 'General' }}
                            </span>
                            @if($decision->estimated_value && $decision->estimated_value !== 'unknown')
                                <span class="inline-flex items-center px-3 py-1 rounded bg-[#eef8f0] text-[#16a34a] text-[11px] font-bold tracking-wide uppercase">
                                    Value: {{ $decision->estimated_value }}
                                </span>
                            @endif
                            <!-- Added Status Badge if viewing "all" or specific statuses just in case -->
                            @if($status === 'all')
                                <span class="text-[11px] font-bold tracking-wide uppercase px-3 py-1 rounded bg-gray-100 text-gray-500">
                                    {{ str_replace('_', ' ', $decision->status) }}
                                </span>
                            @endif

                            <div class="text-[14px] text-gray-500 ml-1">
                                Dari: <span class="font-bold text-gray-800">{{ $decision->lead->name ?? $decision->lead->phone }}</span> 
                                via <span class="font-medium">{{ $decision->persona->persona_name }}</span>
                            </div>
                        </div>
                        <p class="text-[13px] font-medium text-gray-400 shrink-0">
                            {{ $decision->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <!-- Title -->
                    <h4 class="text-[16px] font-bold text-gray-900 mt-1">
                        {{ $decision->brand_name ? "Kerjasama: " . $decision->brand_name : "Peluang Terdeteksi" }}
                        @if($decision->cooperation_type)
                            <span class="text-gray-500 font-medium ml-1">- {{ $decision->cooperation_type }}</span>
                        @endif
                    </h4>

                    <!-- Summary / Excerpt -->
                    <p class="text-gray-500 font-medium text-[14px] leading-relaxed block max-w-4xl">
                        * {{ $decision->summary }} *
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3 pt-3">
                        @if($decision->status === 'needs_review' || $decision->status === 'review_later')
                            <form id="decision-interested-{{ $decision->id }}" action="{{ route('decision-inbox.update', $decision) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="interested">
                                <button
                                    type="button"
                                    class="px-5 py-2.5 bg-[#8cb400] text-white text-[13px] font-bold rounded-lg hover:bg-[#7a9d00] transition-colors shadow-sm js-open-contact-modal {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed disabled' : '' }}"
                                    data-form-id="decision-interested-{{ $decision->id }}"
                                    {{ $leadsDisabled ? 'disabled' : '' }}
                                >
                                    Tertarik
                                </button>
                            </form>
                            <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengabaikan ini?');">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="ignore">
                                <button type="submit" class="px-5 py-2.5 bg-[#f4fadc] text-[#6a8900] text-[13px] font-bold rounded-lg hover:bg-[#ebf5c7] transition-colors {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed disabled' : '' }}" {{ $leadsDisabled ? 'disabled' : '' }}>
                                    Abaikan
                                </button>
                            </form>
                            @if($decision->status !== 'review_later')
                                <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin meninjau ini nanti?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="review_later">
                                <button type="submit" class="px-5 py-2.5 bg-[#f4fadc] text-[#6a8900] text-[13px] font-bold rounded-lg hover:bg-[#ebf5c7] transition-colors {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed disabled' : '' }}" {{ $leadsDisabled ? 'disabled' : '' }}>
                                        Tinjau Nanti
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset status?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="needs_review">
                                    <button type="submit" class="px-5 py-2.5 bg-gray-100 text-gray-600 text-[13px] font-bold rounded-lg hover:bg-gray-200 transition-colors {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed disabled' : '' }}" {{ $leadsDisabled ? 'disabled' : '' }}>
                                        Reset Review
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="px-5 py-2 bg-gray-100 text-gray-600 text-[13px] font-bold rounded-lg">
                                {{ $decision->status === 'interested' ? 'Ditandai Tertarik' : ($decision->status === 'ignore' ? 'Diabaikan' : $decision->status) }}
                            </div>
                            @if($decision->status !== 'needs_review')
                                <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset status?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="needs_review">
                                    <button type="submit" class="px-4 py-2 text-[13px] font-bold text-gray-400 hover:text-gray-600 underline transition-colors {{ $leadsDisabled ? 'disabled cursor-not-allowed opacity-50' : '' }}" {{ $leadsDisabled ? 'disabled' : '' }}>
                                        Kembalikan Status
                                    </button>
                                </form>
                            @endif
                        @endif
                        
                        @if($decision->lead)
                            <a href="{{ $leadsDisabled ? '#' : route('chats.show', $decision->lead) }}" class="ml-4 px-2 py-2 text-[#8cb400] text-[15px] font-bold hover:text-[#7a9d00] underline underline-offset-[3px] decoration-[#8cb400]/40 hover:decoration-[#7a9d00] transition-colors {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                                lihat chat log
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="py-32 px-6 text-center flex flex-col items-center justify-center w-full">
                <div class="relative flex items-center justify-center w-[120px] h-[120px] rounded-full bg-[#fdfee1] mb-6">
                    <div class="flex items-center justify-center w-[80px] h-[80px] rounded-full bg-[#8cb400] shadow-sm">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-[18px] font-bold text-gray-800">Semua beres</h3>
                <p class="text-[14px] font-medium text-gray-500 mt-1.5">Tidak ada keputusan yang perlu ditinjau saat ini.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($decisions->hasPages() || $decisions->total() > 0)
        <div class="px-6 py-4 border-t border-gray-100 bg-white flex justify-between items-center">
            <div class="text-[13px] font-medium text-gray-400">
                Showing {{ $decisions->firstItem() ?? 0 }} to {{ $decisions->lastItem() ?? 0 }} of {{ $decisions->total() }} entries
            </div>
            <div class="flex items-center gap-2">
                {{ $decisions->onEachSide(1)->links('components.pagination') }}
            </div>
        </div>
        @endif
    </div>
</div>

<div id="contactChoiceModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4 hidden">
    <div class="w-full max-w-sm rounded-xl bg-white p-5 shadow-lg">
        <h2 class="text-base font-semibold text-gray-900">Pilih cara follow up</h2>
        <p class="mt-1 text-xs text-gray-500">
            Tentukan apakah Anda atau AI yang akan menghubungi leads ini.
        </p>
        <div class="mt-4 space-y-2">
            <button
                type="button"
                class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                data-contact="manual"
            >
                Saya hubungi manual
            </button>
            <button
                type="button"
                class="w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-[#d4af37] hover:bg-black transition-colors"
                data-contact="ai"
            >
                Biarkan AI menghubungi otomatis
            </button>
        </div>
        <button
            type="button"
            class="mt-4 text-xs text-gray-400 hover:text-gray-600"
            id="contactChoiceCancel"
        >
            Batal
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('contactChoiceModal');
    if (!modal) return;

    var currentForm = null;

    var triggers = document.querySelectorAll('.js-open-contact-modal');
    triggers.forEach(function (button) {
        button.addEventListener('click', function () {
            if (button.disabled) {
                return;
            }
            var formId = button.getAttribute('data-form-id');
            currentForm = formId ? document.getElementById(formId) : null;
            if (!currentForm) {
                return;
            }
            modal.classList.remove('hidden');
        });
    });

    var choiceButtons = modal.querySelectorAll('[data-contact]');
    choiceButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            if (!currentForm) {
                return;
            }
            var method = button.getAttribute('data-contact');
            var existingInput = currentForm.querySelector('input[name="contact_method"]');
            if (!existingInput) {
                existingInput = document.createElement('input');
                existingInput.type = 'hidden';
                existingInput.name = 'contact_method';
                currentForm.appendChild(existingInput);
            }
            existingInput.value = method;

            modal.classList.add('hidden');
            currentForm.submit();
            currentForm = null;
        });
    });

    var cancelButton = document.getElementById('contactChoiceCancel');
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            modal.classList.add('hidden');
            currentForm = null;
        });
    }

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
            currentForm = null;
        }
    });
});
</script>

@endsection
