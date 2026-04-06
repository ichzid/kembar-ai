@extends('layouts.app')

@section('title', 'Detail Percakapan')

@section('content')
<div class="w-full space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp
    
    @if($leadsDisabled)
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded-xl text-sm border border-yellow-100 flex items-start mb-8">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 5a7 7 0 00-7 7 7 7 0 0012.02 4.24" /></svg>
            <div>
                <p class="font-bold">Leads & CRM dalam keadaan nonaktif.</p>
                <p class="mt-1">Aktifkan toggle Leads & CRM di Pengaturan Akun untuk mengaktifkan fitur Leads, Chat Logs, dan Decision Inbox.</p>
            </div>
        </div>
    @endif

    <!-- Header with Back Button -->
    <div class="flex items-center space-x-4 mb-2">
        <a href="{{ route('chats.index') }}" class="p-2.5 rounded-full text-gray-400 hover:text-[#8cb400] hover:bg-[#eef8f0] transition-colors border border-transparent hover:border-[#8cb400]/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-[28px] font-bold text-gray-900 tracking-tight">{{ $lead->name ?? $lead->phone }}</h1>
            <p class="text-gray-500 text-[14px]">Percakapan via {{ ucfirst($lead->source) }} • Persona: <span class="text-gray-700 font-semibold">{{ $lead->persona->persona_name }}</span></p>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden flex flex-col h-[calc(100vh-220px)] {{ $leadsDisabled ? 'opacity-60 pointer-events-none' : '' }}">
        <!-- Chat Header Info -->
        <div class="px-6 py-4 bg-white border-b border-gray-100 flex justify-between items-center z-10 shadow-sm relative">
            <div class="flex items-center space-x-4">
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
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-[15px] font-bold uppercase tracking-widest {{ $color['bg'] }} {{ $color['text'] }}">
                    {{ $initials }}
                </div>
                <div>
                    <h3 class="text-[15px] font-bold text-gray-900">{{ $lead->name ?? 'Tanpa Nama' }}</h3>
                    <p class="text-[13px] font-medium text-gray-500">{{ $lead->phone }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                @if($lead->last_interaction_at && $lead->last_interaction_at->diffInHours(now()) < 24)
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wide bg-[#eef8f0] text-[#25d366]">Active</span>
                @else
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wide bg-gray-100 text-gray-400">Offline</span>
                @endif
            </div>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/30" id="chat-container">
            @forelse($logs as $log)
                <div class="flex {{ $log->from_type === 'bot' ? 'justify-end' : 'justify-start' }}">
                    <div class="flex flex-col {{ $log->from_type === 'bot' ? 'items-end' : 'items-start' }} max-w-[85%] md:max-w-[70%]">
                        <div class="px-5 py-3.5 shadow-sm text-[14px] leading-relaxed {{ $log->from_type === 'bot' ? 'bg-[#8cb400] text-white rounded-2xl rounded-tr-sm' : 'bg-white text-gray-800 border border-gray-100 rounded-2xl rounded-tl-sm' }}">
                            {!! nl2br(e($log->message)) !!}
                        </div>
                        <span class="text-[11px] font-medium text-gray-400 mt-1.5 px-1 flex items-center gap-1.5">
                            @if($log->from_type === 'bot')
                                <svg class="w-3.5 h-3.5 text-[#8cb400]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>AI •</span>
                            @endif
                            {{ $log->created_at->format('H:i, d M') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="w-24 h-24 rounded-full bg-[#f6fbd6] flex items-center justify-center mb-5">
                        <svg width="40" height="40" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 18C38 10.268 31.732 4 24 4C16.268 4 10 10.268 10 18C10 20.9163 10.892 23.6247 12.4338 25.8647L10 32L16.1353 29.5662C18.3753 31.108 21.0837 32 24 32C31.732 32 38 25.732 38 18Z" fill="#b0d648"/>
                            <path d="M38 28C38 21.3726 32.6274 16 26 16C19.3726 16 14 21.3726 14 28C14 30.4984 14.7663 32.8195 16.0864 34.7391L14 40L19.2609 37.9136C21.1805 39.2337 23.5016 40 26 40C32.6274 40 38 34.6274 38 28Z" fill="#6a8900"/>
                        </svg>
                    </div>
                    <h3 class="text-[16px] font-bold text-[#444a5b]">Belum ada riwayat percakapan</h3>
                    <p class="text-[13px] font-medium text-gray-500 mt-1">Interaksi antara persona dan pengguna akan muncul di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Scroll to bottom on load
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('chat-container');
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
@endsection
