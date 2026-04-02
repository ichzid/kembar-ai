@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full space-y-8 bg-white min-h-screen">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-[32px] font-bold text-gray-900 tracking-tight">
                Selamat Datang, <span class="text-[#8cb400]">{{ explode(' ', $user->name)[0] }}</span>
            </h1>
            <p class="text-gray-500 text-[15px] mt-1">Ringkasan aktivitas dan performa Ai persona Anda</p>
        </div>
        <a href="{{ route('personas.create') }}" class="px-5 py-2.5 bg-[#8cb400] text-white text-sm font-semibold rounded-xl hover:bg-[#7a9d00] transition-colors duration-300 flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Persona Baru
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Personas -->
        <div class="bg-[#8cb400] rounded-[20px] p-6 text-white shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[32px] font-bold leading-none mb-1">{{ $totalPersonas }}</h3>
                    <p class="text-[13px] font-medium text-white/90">Persona Aktif</p>
                </div>
                <div class="p-2 bg-[#a3cc00] rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <span class="text-[13px] font-semibold mt-4">Total</span>
        </div>

        <!-- Total Leads -->
        <div class="bg-[#f6fb76] rounded-[20px] p-6 text-gray-900 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div class="flex items-start justify-between">
                <div class="relative z-10">
                    <h3 class="text-[32px] font-bold leading-none mb-1 text-gray-900">{{ $totalLeads }}</h3>
                    <p class="text-[13px] font-medium text-gray-600">Total Person</p>
                </div>
                <div class="p-2 bg-[#bdce35] rounded-full flex items-center justify-center relative z-10">
                    <svg class="w-5 h-5 text-[#4e5e06]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <span class="text-[13px] font-semibold mt-4 relative z-10">Leads</span>
        </div>
        
        <!-- Chat Logs -->
        <div class="bg-[#f9fafb] rounded-[20px] p-6 text-gray-900 shadow-sm flex flex-col justify-between border border-gray-100">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[32px] font-bold leading-none mb-1 text-gray-900">{{ $todayChats }}</h3>
                    <p class="text-[13px] font-medium text-gray-500">Pesan Hari Ini</p>
                </div>
                <div class="p-2 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
            </div>
            <span class="text-[13px] font-semibold mt-4 text-gray-600">Chat Logs</span>
        </div>

        <!-- Pending Decisions -->
        <div class="bg-white rounded-[20px] p-6 text-gray-900 shadow-sm flex flex-col justify-between border border-gray-200">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-[32px] font-bold leading-none mb-1 text-gray-900">{{ $pendingDecisions }}</h3>
                    <p class="text-[13px] font-medium text-gray-500">Menunggu Review</p>
                </div>
                <div class="p-2 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <span class="text-[13px] font-semibold mt-4 text-gray-600">Decisions</span>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity Column -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 font-serif">Aktivitas Terkini</h2>
                </div>
                
                <div class="divide-y divide-gray-100">
                    <!-- Polymorphic Activity Feed -->
                    @forelse($recentActivities as $activity)
                        <div class="px-6 py-4 hover:bg-gray-50 transition-colors flex items-center gap-4">
                            <!-- Icon Logic -->
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                                @if($activity->activity_type == 'chat_log') bg-green-50 text-green-500
                                @elseif($activity->activity_type == 'new_lead') bg-[#f1f6d3] text-[#8cb400]
                                @elseif($activity->activity_type == 'decision') bg-purple-50 text-purple-400
                                @endif">
                                
                                @if($activity->activity_type == 'chat_log' || $activity->activity_type == 'new_lead')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                    </svg>
                                @elseif($activity->activity_type == 'decision')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Content Logic -->
                            <div class="flex-1 min-w-0">
                                <p class="text-[14px] font-semibold text-gray-900 truncate">
                                    @if($activity->activity_type == 'chat_log')
                                        Pesan baru dari {{ $activity->lead ? $activity->lead->name : ($activity->lead->phone ?? 'Unknown') }}
                                    @elseif($activity->activity_type == 'new_lead')
                                        Pesan baru dari {{ $activity->name ?? $activity->phone }}
                                    @elseif($activity->activity_type == 'decision')
                                        Keputusan diperlukan: {{ $activity->summary ?? 'New Inquiry' }}
                                    @endif
                                </p>
                                <p class="text-[13px] text-gray-500 mt-0.5">
                                    @if($activity->activity_type == 'chat_log')
                                        "{{ Str::limit($activity->message, 50) }}"
                                    @elseif($activity->activity_type == 'new_lead')
                                        Via {{ ucfirst($activity->source) }}
                                    @elseif($activity->activity_type == 'decision')
                                        Intent: {{ $activity->detected_intent }}
                                    @endif
                                    • {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Badge Logic -->
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-semibold tracking-wide 
                                @if($activity->activity_type == 'chat_log' || $activity->activity_type == 'new_lead') bg-[#eef6ec] text-[#2c6e26]
                                @elseif($activity->activity_type == 'decision') bg-[#eeecfc] text-[#4d3ab3]
                                @endif">
                                @if($activity->activity_type == 'chat_log' || $activity->activity_type == 'new_lead') Chat
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
                
                <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between border-t border-gray-100 bg-gray-50/50 rounded-b-2xl gap-4">
                    <p class="text-[13px] text-gray-500">
                        Showing {{ $recentActivities->firstItem() ?? 0 }} to {{ $recentActivities->lastItem() ?? 0 }} of {{ $recentActivities->total() }} entries
                    </p>
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 w-full sm:w-auto">
                        <form method="GET" class="flex items-center text-[13px] text-gray-600">
                            @foreach(request()->except('per_page', 'page') as $key => $val)
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endforeach
                            <span class="mr-2">Rows per page</span>
                            <div class="relative">
                                <select name="per_page" onchange="this.form.submit()" class="appearance-none border border-gray-200 rounded-md pl-3 pr-8 py-1.5 bg-white focus:outline-none focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] cursor-pointer">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                </select>
                                <svg class="w-3 h-3 absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </form>
                        <div class="flex items-center space-x-1 text-[13px]">
                            @if ($recentActivities->onFirstPage())
                                <button disabled class="px-2 py-1 text-gray-400 font-medium cursor-not-allowed opacity-50">&lt; Previous</button>
                            @else
                                <a href="{{ $recentActivities->previousPageUrl() }}" class="px-2 py-1 text-gray-600 hover:text-[#8cb400] font-medium transition-colors">&lt; Previous</a>
                            @endif

                            @if($recentActivities->lastPage() > 0)
                                @foreach ($recentActivities->getUrlRange(max(1, $recentActivities->currentPage() - 1), min($recentActivities->lastPage(), $recentActivities->currentPage() + 1)) as $page => $url)
                                    @if ($page == $recentActivities->currentPage())
                                        <span class="px-2.5 py-1 bg-[#8cb400]/10 text-[#8cb400] rounded font-semibold">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-2.5 py-1 text-gray-600 font-semibold hover:bg-gray-100 hover:text-[#8cb400] rounded transition-colors">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif

                            @if ($recentActivities->hasMorePages())
                                <a href="{{ $recentActivities->nextPageUrl() }}" class="px-2 py-1 text-[#8cb400] font-medium hover:text-[#7a9d00] transition-colors">Next &gt;</a>
                            @else
                                <button disabled class="px-2 py-1 text-gray-400 font-medium cursor-not-allowed opacity-50">Next &gt;</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div>
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-bold text-gray-900 mb-5 font-serif text-lg">Aksi Cepat</h3>
                <div class="space-y-4">
                    <a href="{{ route('whatsapp.index') }}" class="w-full text-left px-4 py-3.5 rounded-[14px] bg-white border border-gray-200 hover:border-[#8cb400] hover:shadow-sm text-gray-800 font-semibold text-sm transition-all duration-300 flex items-center group">
                        <div class="w-8 h-8 bg-[#cdda28] rounded-md mr-4 flex items-center justify-center border border-[#bad500]">
                            <svg class="w-5 h-5 text-[#4e5e06]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        Kelola Whatsapps
                    </a>
                    <a href="{{ route('decision-inbox.index') }}" class="w-full text-left px-4 py-3.5 rounded-[14px] bg-white border border-gray-200 hover:border-[#8cb400] hover:shadow-sm text-gray-800 font-semibold text-sm transition-all duration-300 flex items-center group">
                        <div class="w-8 h-8 bg-[#cdda28] rounded-md mr-4 flex items-center justify-center border border-[#bad500]">
                            <svg class="w-5 h-5 text-[#4e5e06]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        Decision Inbox
                    </a>
                    <a href="{{ route('leads.index') }}" class="w-full text-left px-4 py-3.5 rounded-[14px] bg-white border border-gray-200 hover:border-[#8cb400] hover:shadow-sm text-gray-800 font-semibold text-sm transition-all duration-300 flex items-center group">
                        <div class="w-8 h-8 bg-[#cdda28] rounded-md mr-4 flex items-center justify-center border border-[#bad500]">
                            <svg class="w-5 h-5 text-[#4e5e06]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        Daftar Lead
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
