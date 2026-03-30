@extends('layouts.app')

@section('title', 'Decision Inbox')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight">Decision Inbox</h1>
            <p class="text-gray-500 text-base md:text-lg font-light">Prioritaskan peluang yang perlu tindakan dari Anda.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'needs_review']) }}" 
               class="px-4 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $status === 'needs_review' ? 'bg-gray-900 text-[#d4af37]' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                Perlu Review
            </a>
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'interested']) }}" 
               class="px-4 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $status === 'interested' ? 'bg-gray-900 text-[#d4af37]' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                Tertarik
            </a>
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'ignore']) }}" 
               class="px-4 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $status === 'ignore' ? 'bg-gray-900 text-[#d4af37]' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                Diabaikan
            </a>
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'review_later']) }}" 
               class="px-4 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $status === 'review_later' ? 'bg-gray-900 text-[#d4af37]' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                Tinjau Nanti
            </a>
            <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.index', ['status' => 'all']) }}" 
               class="px-4 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $status === 'all' ? 'bg-gray-900 text-[#d4af37]' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }} {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                Semua
            </a>
        </div>
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

    @if($leadsDisabled)
        <div class="rounded-2xl border border-yellow-200 bg-yellow-50 px-4 py-3 flex items-start space-x-3">
            <div class="mt-0.5">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 5a7 7 0 00-7 7 7 7 0 0012.02 4.24" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-800">Leads & CRM dalam keadaan nonaktif.</p>
                <p class="text-xs text-yellow-700 mt-1">
                    Aktifkan toggle Leads & CRM di Pengaturan Akun untuk mengaktifkan fitur Leads, Chat Logs, dan Decision Inbox.
                </p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden {{ $leadsDisabled ? 'opacity-60' : '' }}">
        <div class="p-4 md:p-6 border-b border-gray-100 bg-gray-50 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <h3 class="font-medium text-gray-900 text-sm md:text-base">
                @if($status === 'needs_review') Perlu Persetujuan
                @elseif($status === 'interested') Tertarik
                @elseif($status === 'ignore') Diabaikan
                @elseif($status === 'review_later') Tinjau Nanti
                @else Semua Keputusan
                @endif
            </h3>
            <div class="w-full md:w-auto">
                <a href="{{ $leadsDisabled ? '#' : route('decision-inbox.export', ['status' => $status]) }}" 
                   class="inline-flex w-full md:w-auto justify-center px-4 py-2 text-sm font-medium rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 items-center shadow-sm transition-colors group {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                    <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($decisions as $decision)
            <div class="p-4 md:p-6 hover:bg-gray-50 transition-colors">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex-1 space-y-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                {{ $decision->detected_intent ?? 'General' }}
                            </span>
                            @if($decision->estimated_value && $decision->estimated_value !== 'unknown')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Value: {{ $decision->estimated_value }}
                                </span>
                            @endif
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-700">
                                {{ ucfirst($decision->status) }}
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div class="space-y-1">
                                <p class="text-sm text-gray-500">
                                    Dari: <span class="font-medium text-gray-900">{{ $decision->lead->name ?? $decision->lead->phone }}</span>
                                </p>
                                <p class="text-xs text-gray-400">
                                    via {{ $decision->persona->persona_name }}
                                </p>
                            </div>
                            <p class="text-xs text-gray-400 sm:text-right">
                                {{ $decision->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <h4 class="text-base md:text-lg font-semibold text-gray-900">
                            {{ $decision->brand_name ? "Kerjasama: " . $decision->brand_name : "Peluang Baru Terdeteksi" }}
                            @if($decision->cooperation_type)
                                <span class="text-gray-500 font-normal">· {{ $decision->cooperation_type }}</span>
                            @endif
                        </h4>

                        <p class="text-gray-600 text-sm bg-gray-50 p-3 rounded-xl border border-gray-100 line-clamp-3">
                            "{{ $decision->summary }}"
                        </p>

                        <div class="flex flex-wrap items-center gap-2 pt-1">
                            @if($decision->status === 'needs_review' || $decision->status === 'review_later')
                                <form id="decision-interested-{{ $decision->id }}" action="{{ route('decision-inbox.update', $decision) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="interested">
                                    <button
                                        type="button"
                                        class="px-4 py-2 bg-gray-900 text-[#d4af37] text-sm font-medium rounded-lg hover:bg-black transition-colors js-open-contact-modal"
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
                                    <button type="submit" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" {{ $leadsDisabled ? 'disabled' : '' }}>
                                        Abaikan
                                    </button>
                                </form>
                                @if($decision->status !== 'review_later')
                                    <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin meninjau ini nanti?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="review_later">
                                    <button type="submit" class="px-4 py-2 bg-white border border-gray-300 text-yellow-600 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" {{ $leadsDisabled ? 'disabled' : '' }}>
                                            Tinjau Nanti
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset status?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="needs_review">
                                        <button type="submit" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 underline" {{ $leadsDisabled ? 'disabled' : '' }}>
                                            Reset
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 bg-gray-50 text-gray-500">
                                    {{ $decision->status === 'interested' ? 'Ditandai Tertarik' : ($decision->status === 'ignore' ? 'Diabaikan' : $decision->status) }}
                                </span>
                                @if($decision->status !== 'needs_review')
                                    <form action="{{ route('decision-inbox.update', $decision) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset status?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="needs_review">
                                    <button type="submit" class="text-xs text-gray-400 underline hover:text-gray-600 ml-2" {{ $leadsDisabled ? 'disabled' : '' }}>
                                            Reset
                                        </button>
                                    </form>
                                @endif
                            @endif
                            
                            @if($decision->lead)
                                <a href="{{ $leadsDisabled ? '#' : route('chats.show', $decision->lead) }}" class="px-4 py-2 text-gray-500 text-sm hover:text-gray-700 underline decoration-gray-300 underline-offset-4 {{ $leadsDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                                    Lihat Chat Log
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Semua Beres!</h3>
                <p class="text-gray-500 mt-2">Tidak ada keputusan yang perlu ditinjau saat ini.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($decisions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $decisions->links() }}
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
