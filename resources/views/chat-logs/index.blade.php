@extends('layouts.app')

@section('title', 'Chat Logs')

@section('content')
<div class="w-full space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-10">
        <div>
            <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-2">Chat Logs</h1>
            <p class="text-gray-500 text-[14px]">Riwayat percakapan antara persona dan pengguna</p>
        </div>
        <div class="w-full md:w-[320px]">
            <form action="{{ route('chats.index') }}" method="GET" class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search', $search ?? '') }}"
                    placeholder="Cari percakapan..."
                    class="w-full pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl text-[14px] font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors shadow-sm {{ $leadsDisabled ? 'bg-gray-50 text-gray-400 cursor-not-allowed' : '' }}"
                    {{ $leadsDisabled ? 'disabled' : '' }}
                >
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8cb400] transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    @if($leadsDisabled)
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded-xl text-sm border border-yellow-100 flex items-start mb-8">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <p class="font-bold">Leads & CRM dalam keadaan nonaktif.</p>
                <p class="mt-1">Aktifkan toggle Leads & CRM di Pengaturan Akun untuk mengaktifkan fitur Leads, Chat Logs, dan Decision Inbox.</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden {{ $leadsDisabled ? 'opacity-60 pointer-events-none' : '' }}">
        @if($leads->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-28 px-6 text-center">
                <div class="w-32 h-32 rounded-full bg-[#f6fbd6] flex items-center justify-center mb-6">
                    <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38 18C38 10.268 31.732 4 24 4C16.268 4 10 10.268 10 18C10 20.9163 10.892 23.6247 12.4338 25.8647L10 32L16.1353 29.5662C18.3753 31.108 21.0837 32 24 32C31.732 32 38 25.732 38 18Z" fill="#b0d648"/>
                        <path d="M38 28C38 21.3726 32.6274 16 26 16C19.3726 16 14 21.3726 14 28C14 30.4984 14.7663 32.8195 16.0864 34.7391L14 40L19.2609 37.9136C21.1805 39.2337 23.5016 40 26 40C32.6274 40 38 34.6274 38 28Z" fill="#6a8900"/>
                        <circle cx="20" cy="28" r="2.5" fill="white"/>
                        <circle cx="26" cy="28" r="2.5" fill="white"/>
                        <circle cx="32" cy="28" r="2.5" fill="white"/>
                    </svg>
                </div>
                <h3 class="text-[17px] font-bold text-[#444a5b]">Belum ada percakapan</h3>
                <p class="text-[14px] font-medium text-gray-500 mt-1.5">Chat logs akan muncul di sini setelah ada interaksi dengan persona Anda.</p>
            </div>
        @else
            <!-- Real chat logs list grid -->
            <div class="grid grid-cols-1 divide-y divide-gray-100">
                @foreach($leads as $lead)
                <!-- Chat Session Item -->
                <a href="{{ $leadsDisabled ? '#' : route('chats.show', $lead) }}" class="block bg-white p-6 hover:bg-gray-50/50 transition-all duration-200 group {{ $leadsDisabled ? 'cursor-not-allowed pointer-events-none' : '' }}">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                        <div class="flex items-start space-x-4 w-full">
                            <div class="flex-shrink-0">
                                @php
                                    $colors = [
                                        ['bg' => 'bg-red-50', 'text' => 'text-red-500'],
                                        ['bg' => 'bg-amber-50', 'text' => 'text-amber-500'],
                                        ['bg' => 'bg-green-50', 'text' => 'text-green-500'],
                                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'],
                                    ];
                                    $color = $colors[abs(crc32($lead->name ?? 'U')) % count($colors)];
                                    $nameParts = explode(' ', trim($lead->name ?? 'T'));
                                    $initials = strtolower((isset($nameParts[0][0]) ? $nameParts[0][0] : 't') . (isset($nameParts[1][0]) ? $nameParts[1][0] : ''));
                                @endphp
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-[13px] font-bold uppercase tracking-widest {{ $color['bg'] }} {{ $color['text'] }}">
                                    {{ $initials }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2">
                                    <h4 class="text-[14px] font-bold text-gray-800 transition-colors truncate">
                                        {{ $lead->name ?? $lead->phone }}
                                    </h4>
                                    @if($lead->last_interaction_at && $lead->last_interaction_at->diffInHours(now()) < 24)
                                        <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wide bg-[#eef8f0] text-[#25d366]">Active</span>
                                    @endif
                                </div>
                                <p class="text-[12px] text-gray-400 mt-0.5 font-medium">Persona: <span class="text-gray-600">{{ $lead->persona->persona_name }}</span></p>
                                
                                <div class="text-[13px] text-gray-600 mt-3 p-3 bg-gray-50/50 rounded-lg border border-gray-100">
                                    @forelse($lead->recent_logs ?? collect() as $log)
                                        <div class="mb-1 last:mb-0 truncate">
                                            <span class="font-bold {{ $log->from_type === 'bot' ? 'text-[#8cb400]' : 'text-gray-700' }}">
                                                {{ $log->from_type === 'bot' ? 'AI' : 'User' }}:
                                            </span>
                                            <span class="text-gray-600 font-medium">{{ Str::limit($log->message, 100) }}</span>
                                        </div>
                                    @empty
                                        <span class="text-gray-400 italic">Belum ada riwayat percakapan.</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="text-left md:text-right w-full md:w-auto pl-14 md:pl-0 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-400">
                                {{ $lead->last_interaction_at ? $lead->last_interaction_at->diffForHumans() : 'Belum ada interaksi' }}
                            </p>
                            @if(isset($lead->source))
                                <div class="mt-1 text-[11px] font-bold uppercase tracking-wide text-gray-400">Via {{ $lead->source }}</div>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($leads->hasPages() || $leads->total() > 0)
            <div class="px-6 py-4 border-t border-gray-100 bg-white flex justify-between items-center">
                <div class="text-[13px] font-medium text-gray-400">
                    Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} entries
                </div>
                <div class="flex items-center gap-2">
                    {{ $leads->onEachSide(1)->links('components.pagination') }}
                </div>
            </div>
            @endif
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeout = null;
    const searchInputs = document.querySelectorAll('input[name="search"]');
    
    // Check if we should auto-focus after reload
    const shouldFocus = sessionStorage.getItem('chats_search_focus');
    
    searchInputs.forEach(input => {
        // Restore focus if needed
        if (shouldFocus && input.value && input.offsetParent !== null) {
            setTimeout(() => {
                input.focus();
                const len = input.value.length;
                input.setSelectionRange(len, len);
            }, 10);
        }

        input.addEventListener('input', function() {
            clearTimeout(timeout);
            sessionStorage.setItem('chats_search_focus', 'true');
            timeout = setTimeout(() => {
                this.closest('form').submit();
            }, 600); 
        });

        input.addEventListener('blur', () => {
            setTimeout(() => {
                sessionStorage.removeItem('chats_search_focus');
            }, 200);
        });
    });
});
</script>
@endsection
