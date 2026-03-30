@extends('layouts.app')

@section('title', 'Chat Logs')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight">Chat Logs</h1>
            <p class="text-gray-500 text-base md:text-lg font-light">Riwayat percakapan antara Persona dan pengguna.</p>
        </div>
        <div class="flex space-x-3 w-full md:w-auto">
             <form action="{{ route('chats.index') }}" method="GET" class="relative w-full md:w-auto">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari percakapan..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4af37]/50 focus:border-[#d4af37] text-sm w-full md:w-64 {{ $leadsDisabled ? 'bg-gray-50 text-gray-400 cursor-not-allowed' : '' }}"
                    {{ $leadsDisabled ? 'disabled' : '' }}
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>
        </div>
    </div>

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

    <div class="grid grid-cols-1 gap-4 {{ $leadsDisabled ? 'opacity-60' : '' }}">
        @forelse($leads as $lead)
        <!-- Chat Session Item -->
        <a href="{{ $leadsDisabled ? '#' : route('chats.show', $lead) }}" class="block bg-white rounded-xl border border-gray-100 p-4 md:p-6 shadow-sm hover:shadow-md transition-all duration-200 group {{ $leadsDisabled ? 'cursor-not-allowed pointer-events-none' : '' }}">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="flex items-start space-x-4 w-full">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gray-900 flex items-center justify-center text-[#d4af37]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-2">
                            <h4 class="text-lg font-medium text-gray-900 group-hover:text-[#d4af37] transition-colors truncate">
                                {{ $lead->name ?? $lead->phone }}
                            </h4>
                            @if($lead->last_interaction_at && $lead->last_interaction_at->diffInHours(now()) < 24)
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Persona: <span class="font-medium text-gray-700">{{ $lead->persona->persona_name }}</span></p>
                        
                        <div class="text-sm text-gray-600 mt-2 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            @forelse($lead->recent_logs as $log)
                                <div class="mb-1 last:mb-0">
                                    <span class="font-semibold {{ $log->from_type === 'bot' ? 'text-[#d4af37]' : 'text-gray-700' }}">
                                        {{ $log->from_type === 'bot' ? 'AI' : 'User' }}:
                                    </span>
                                    <span class="text-gray-600">{{ Str::limit($log->message, 100) }}</span>
                                </div>
                            @empty
                                <span class="text-gray-400 italic">Belum ada riwayat percakapan.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="text-left md:text-right w-full md:w-auto pl-16 md:pl-0 flex-shrink-0">
                    <p class="text-xs text-gray-400">
                        {{ $lead->last_interaction_at ? $lead->last_interaction_at->diffForHumans() : 'Belum ada interaksi' }}
                    </p>
                    <div class="mt-2 text-xs text-gray-400">Via {{ ucfirst($lead->source) }}</div>
                </div>
            </div>
        </a>
        @empty
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">Belum ada percakapan</h3>
            <p class="text-gray-500 mt-2">Chat logs akan muncul di sini setelah ada interaksi dengan persona Anda.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($leads->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
        {{ $leads->links() }}
    </div>
    @endif
</div>
@endsection
