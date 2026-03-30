@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-8 space-y-8">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-4xl font-display font-bold text-gray-900 tracking-tight">
                Selamat Datang, <span class="text-[#d4af37]">{{ explode(' ', $user->name)[0] }}</span>
            </h1>
            <p class="text-gray-500 text-lg font-light mt-2">Ringkasan aktivitas dan performa AI persona Anda.</p>
        </div>
        <a href="{{ route('personas.create') }}" class="px-6 py-3 bg-gray-900 text-[#d4af37] text-sm font-medium rounded-lg shadow-lg shadow-gray-900/20 hover:bg-black hover:shadow-xl hover:shadow-gray-900/30 transition-all duration-300 flex items-center border border-gray-800">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Persona Baru
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Personas -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-gray-900 group-hover:text-[#d4af37] transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalPersonas }}</h3>
            <p class="text-sm text-gray-500 font-medium">Persona Aktif</p>
        </div>

        <!-- Total Leads -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-gray-900 group-hover:text-[#d4af37] transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Leads</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalLeads }}</h3>
            <p class="text-sm text-gray-500 font-medium">Total Prospek</p>
        </div>
        
        <!-- Chat Logs (Dummy) -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-gray-900 group-hover:text-[#d4af37] transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Chat Logs</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $todayChats }}</h3>
            <p class="text-sm text-gray-500 font-medium">Pesan Hari Ini</p>
        </div>

        <!-- Pending Decisions (Dummy) -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-gray-900 group-hover:text-[#d4af37] transition-colors duration-300">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#d4af37] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Decisions</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingDecisions }}</h3>
            <p class="text-sm text-gray-500 font-medium">Menunggu Review</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activity Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-display font-bold text-gray-900">Aktivitas Terkini</h2>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="divide-y divide-gray-100">
                    <!-- Polymorphic Activity Feed -->
                    @forelse($recentActivities as $activity)
                        <div class="p-4 hover:bg-gray-50 transition-colors flex items-center gap-4">
                            <!-- Icon Logic -->
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                                @if($activity->activity_type == 'chat_log') bg-green-100 text-green-600
                                @elseif($activity->activity_type == 'new_lead') bg-blue-100 text-blue-600
                                @elseif($activity->activity_type == 'decision') bg-purple-100 text-purple-600
                                @endif">
                                
                                @if($activity->activity_type == 'chat_log')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                    </svg>
                                @elseif($activity->activity_type == 'new_lead')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                @elseif($activity->activity_type == 'decision')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Content Logic -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    @if($activity->activity_type == 'chat_log')
                                        Pesan baru dari <span class="font-bold">{{ $activity->lead ? $activity->lead->name : ($activity->lead->phone ?? 'Unknown') }}</span>
                                    @elseif($activity->activity_type == 'new_lead')
                                        Prospek baru terdaftar: <span class="font-bold">{{ $activity->name ?? $activity->phone }}</span>
                                    @elseif($activity->activity_type == 'decision')
                                        Keputusan diperlukan: <span class="font-bold">{{ $activity->summary ?? 'New Inquiry' }}</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    @if($activity->activity_type == 'chat_log')
                                        "{{ Str::limit($activity->message, 50) }}"
                                    @elseif($activity->activity_type == 'new_lead')
                                        Via {{ ucfirst($activity->source) }} • {{ $activity->city ?? 'Lokasi tidak diketahui' }}
                                    @elseif($activity->activity_type == 'decision')
                                        Intent: {{ $activity->detected_intent }} • Value: {{ ucfirst($activity->estimated_value) }}
                                    @endif
                                    • {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Badge Logic -->
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($activity->activity_type == 'chat_log') bg-green-100 text-green-800
                                @elseif($activity->activity_type == 'new_lead') bg-blue-100 text-blue-800
                                @elseif($activity->activity_type == 'decision') bg-purple-100 text-purple-800
                                @endif">
                                @if($activity->activity_type == 'chat_log') Chat
                                @elseif($activity->activity_type == 'new_lead') Lead
                                @elseif($activity->activity_type == 'decision') Decision
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            Belum ada aktivitas terbaru.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="space-y-6 sticky top-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-display font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('whatsapp.index') }}" class="w-full text-left px-4 py-3 rounded-xl bg-white border border-gray-100 hover:border-[#d4af37] hover:shadow-lg hover:shadow-[#d4af37]/10 text-gray-700 hover:text-gray-900 text-sm font-medium transition-all duration-300 flex items-center group">
                        <div class="p-2 bg-[#d4af37]/10 rounded-lg mr-3 group-hover:bg-[#d4af37] transition-all duration-300">
                            <svg class="w-4 h-4 text-[#d4af37] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <span class="font-display">Kelola WhatsApp</span>
                    </a>
                    <a href="{{ route('decision-inbox.index') }}" class="w-full text-left px-4 py-3 rounded-xl bg-white border border-gray-100 hover:border-[#d4af37] hover:shadow-lg hover:shadow-[#d4af37]/10 text-gray-700 hover:text-gray-900 text-sm font-medium transition-all duration-300 flex items-center group">
                        <div class="p-2 bg-[#d4af37]/10 rounded-lg mr-3 group-hover:bg-[#d4af37] transition-all duration-300">
                            <svg class="w-4 h-4 text-[#d4af37] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <span class="font-display">Decision Inbox</span>
                    </a>
                    <a href="{{ route('leads.index') }}" class="w-full text-left px-4 py-3 rounded-xl bg-white border border-gray-100 hover:border-[#d4af37] hover:shadow-lg hover:shadow-[#d4af37]/10 text-gray-700 hover:text-gray-900 text-sm font-medium transition-all duration-300 flex items-center group">
                        <div class="p-2 bg-[#d4af37]/10 rounded-lg mr-3 group-hover:bg-[#d4af37] transition-all duration-300">
                            <svg class="w-4 h-4 text-[#d4af37] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="font-display">Daftar Leads</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
