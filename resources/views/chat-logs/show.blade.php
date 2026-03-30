@extends('layouts.app')

@section('title', 'Detail Percakapan')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-6">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp
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

    <!-- Header with Back Button -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('chats.index') }}" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-display font-bold text-gray-900">{{ $lead->name ?? $lead->phone }}</h1>
            <p class="text-gray-500 text-sm">Percakapan via {{ ucfirst($lead->source) }} • Persona: {{ $lead->persona->persona_name }}</p>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-[calc(100vh-200px)] {{ $leadsDisabled ? 'opacity-60' : '' }}">
        <!-- Chat Header Info -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                    {{ substr($lead->name ?? '?', 0, 2) }}
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $lead->name ?? 'Tanpa Nama' }}</h3>
                    <p class="text-xs text-gray-500">{{ $lead->phone }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                @if($lead->last_interaction_at && $lead->last_interaction_at->diffInHours(now()) < 24)
                    <span class="flex h-2.5 w-2.5 rounded-full bg-green-500"></span>
                    <span class="text-xs text-gray-500">Active</span>
                @else
                    <span class="flex h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                    <span class="text-xs text-gray-500">Offline</span>
                @endif
            </div>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/50" id="chat-container">
            @forelse($logs as $log)
                <div class="flex {{ $log->from_type === 'bot' ? 'justify-end' : 'justify-start' }}">
                    <div class="flex flex-col {{ $log->from_type === 'bot' ? 'items-end' : 'items-start' }} max-w-[80%]">
                        <div class="px-4 py-3 rounded-2xl shadow-sm text-sm {{ $log->from_type === 'bot' ? 'bg-gray-900 text-white rounded-tr-none' : 'bg-white text-gray-800 border border-gray-100 rounded-tl-none' }}">
                            {{ $log->message }}
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1 px-1">
                            {{ $log->from_type === 'bot' ? 'AI • ' : '' }}
                            {{ $log->created_at->format('H:i, d M') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-full text-gray-400">
                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-sm">Belum ada riwayat percakapan</p>
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
