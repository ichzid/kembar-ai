@extends('layouts.app')

@section('title', 'Leads Management')

@section('content')
<div class="w-full space-y-8">
    @php
        $leadsDisabled = auth()->check() && !auth()->user()->leads_enabled;
    @endphp

    <!-- Header -->
    <div class="mb-10 text-left">
        <h1 class="text-[32px] font-bold text-gray-900 tracking-tight mb-2">Leads</h1>
        <p class="text-gray-500 text-[14px]">Prospek yang terkumpul dari interaksi Ai.</p>
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

    <!-- Main Container -->
    <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 overflow-hidden {{ $leadsDisabled ? 'opacity-60 pointer-events-none' : '' }}">
        
        <!-- Top Toolbar -->
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white hidden sm:flex">
            <form method="GET" action="{{ route('leads.index') }}" class="relative w-full sm:w-[320px]">
                @foreach(request()->except('search', 'page') as $key => $value)
                    @if(!is_array($value))
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or phone..." 
                    class="w-full pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl text-[14px] font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors shadow-sm">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8cb400] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
            <a href="{{ $leadsDisabled ? '#' : route('leads.export') }}" 
                class="flex items-center justify-center px-5 py-2.5 bg-[#8cb400] text-white text-[13px] font-bold rounded-xl hover:bg-[#7a9d00] transition-colors shadow-sm gap-2 w-full sm:w-auto">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                </svg>
                Export CSV
            </a>
        </div>
        
        <!-- Top Toolbar Mobile (Optional styling) -->
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col gap-4 bg-white sm:hidden">
            <div class="w-full flex justify-between gap-4">
               <form method="GET" action="{{ route('leads.index') }}" class="relative w-full">
                    @foreach(request()->except('search', 'page') as $key => $value)
                        @if(!is_array($value))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                   <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." 
                        class="w-full pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl text-[14px] font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors shadow-sm">
                   <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8cb400]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                   </button>
               </form>

                <a href="{{ $leadsDisabled ? '#' : route('leads.export', request()->query()) }}" 
                    class="flex items-center justify-center px-4 py-2.5 bg-[#8cb400] text-white rounded-xl hover:bg-[#7a9d00] transition-colors shadow-sm shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left border-collapse">
                <thead>
                    <tr class="bg-[#fcfcfc] border-b border-gray-100/80">
                        <th class="px-6 py-4 text-[13px] font-semibold text-gray-500">
                            Nama 
                            <span class="inline-flex flex-col ml-1 opacity-60 relative top-0.5">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                                <svg class="w-2 h-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </th>
                        <th class="px-6 py-4 text-[13px] font-semibold text-gray-500">Kontak</th>
                        <th class="px-6 py-4 text-[13px] font-semibold text-gray-500">Alamat & Minat</th>
                        <th class="px-6 py-4 text-[13px] font-semibold text-gray-500">Tahapan</th>
                        <th class="px-6 py-4 text-[13px] font-semibold text-gray-500">Terakhir interaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php
                        $colors = [
                            ['bg' => 'bg-red-50', 'text' => 'text-red-500'],
                            ['bg' => 'bg-amber-50', 'text' => 'text-amber-500'],
                            ['bg' => 'bg-green-50', 'text' => 'text-green-500'],
                            ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'],
                            ['bg' => 'bg-purple-50', 'text' => 'text-purple-500'],
                            ['bg' => 'bg-pink-50', 'text' => 'text-pink-500'],
                        ];
                    @endphp

                    @forelse($leads as $lead)
                    @php
                        $color = $colors[abs(crc32($lead->name ?? 'U')) % count($colors)];
                        
                        $nameParts = explode(' ', trim($lead->name ?? 'T'));
                        $firstInitial = isset($nameParts[0][0]) ? strtolower($nameParts[0][0]) : 't';
                        $secondInitial = isset($nameParts[1][0]) ? strtolower($nameParts[1][0]) : (isset($nameParts[0][1]) ? strtolower($nameParts[0][1]) : '');
                        $initials = $firstInitial . $secondInitial;
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-[13px] tracking-widest uppercase shrink-0 {{ $color['bg'] }} {{ $color['text'] }}">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <div class="text-[14px] font-bold text-gray-700">{{ $lead->name ?? 'Tanpa Nama' }}</div>
                                    <div class="text-[12px] text-gray-400 font-medium mt-0.5">{{ Str::limit($lead->persona->persona_name ?? 'Tanpa Persona', 25) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[14px] font-medium text-gray-600">{{ $lead->phone }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[13px] font-medium text-gray-600 truncate max-w-[280px]" title="{{ $lead->address }}">
                                {{ $lead->address ?? '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if(strtolower($lead->conversation_stage) === 'new')
                                <span class="px-3 py-1 bg-[#eef8f0] text-[#25d366] text-[12px] font-bold rounded-full">New</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-[12px] font-bold rounded-full">{{ ucfirst($lead->conversation_stage ?? 'New') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[13px] font-medium text-gray-500">{{ $lead->last_interaction_at ? $lead->last_interaction_at->diffForHumans() : '-' }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-[4.5rem] text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <!-- Illustrated Empty State SVG -->
                                <svg width="180" height="120" viewBox="0 0 180 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4">
                                    <!-- Left Paper (Yellowish) -->
                                    <g transform="translate(60, 50) rotate(-25) translate(-60, -50)">
                                        <rect x="40" y="20" width="35" height="45" rx="2" fill="#fffcce" stroke="#f6f2a8" stroke-width="1.5"/>
                                        <line x1="48" y1="30" x2="65" y2="30" stroke="#f0e960" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="48" y1="38" x2="60" y2="38" stroke="#f0e960" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M58 48 h6 m-3 -3 v6" stroke="#d5cc28" stroke-width="2" stroke-linecap="round"/>
                                    </g>
                                    
                                    <!-- Right Paper (White/Yellow) -->
                                    <g transform="translate(130, 50) rotate(35) translate(-130, -50)">
                                        <rect x="110" y="25" width="35" height="45" rx="2" fill="#fffeee" stroke="#fdfbd6" stroke-width="1.5"/>
                                        <line x1="118" y1="35" x2="135" y2="35" stroke="#eade9e" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="118" y1="43" x2="130" y2="43" stroke="#eade9e" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M128 53 h6 m-3 -3 v6" stroke="#c0b15b" stroke-width="2" stroke-linecap="round"/>
                                    </g>

                                    <!-- Center Paper (White) -->
                                    <g transform="translate(95, 45) rotate(12) translate(-95, -45)">
                                        <rect x="75" y="15" width="40" height="50" rx="2" fill="#ffffff" stroke="#f0f0f0" stroke-width="1.5"/>
                                        <line x1="85" y1="28" x2="105" y2="28" stroke="#e0e0e0" stroke-width="2" stroke-linecap="round"/>
                                        <line x1="85" y1="38" x2="100" y2="38" stroke="#e0e0e0" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M98 48 h8 m-4 -4 v8" stroke="#a0a0a0" stroke-width="2" stroke-linecap="round"/>
                                    </g>

                                    <!-- Folder Back Cover -->
                                    <rect x="62" y="52" width="70" height="30" rx="3" fill="#6a8900"/>
                                    <path d="M62 52 h25 l5 -5 h35 a3 3 0 0 1 3 3 v20 a0 0 0 0 1 0 0 h-68 z" fill="#587200"/>
                                    
                                    <!-- Decorative Leaves Bottom Left -->
                                    <path d="M48 78 Q38 73 42 63 Q52 65 48 78" fill="#a4cd39"/>
                                    <path d="M48 80 Q43 88 53 88 Q58 80 48 80" fill="#a4cd39"/>

                                    <!-- Folder Front Cover -->
                                    <path d="M50 63 l12 -8 h70 a3 3 0 0 1 3 3 v27 a3 3 0 0 1 -3 3 h-78 a2 2 0 0 1 -2 -2 l-2 -23 z" fill="#8cb400"/>
                                </svg>
                                
                                <p class="text-[17px] font-bold text-[#444a5b]">Belum ada leads</p>
                                <p class="text-[13.5px] text-gray-500 mt-1.5 font-medium">Data leads akan muncul disini setelah interaksi dimulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        @if($leads->hasPages() || $leads->total() > 0)
        <div class="bg-white border-t border-gray-100 px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-[13px] font-medium text-gray-400">
                Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} entries
            </div>
            
            <div class="flex items-center gap-6">
                <div class="hidden sm:flex items-center gap-2">
                    <span class="text-[13px] font-semibold text-gray-600">Rows per page</span>
                    <form method="GET" action="{{ route('leads.index') }}">
                        @foreach(request()->except('per_page', 'page') as $key => $value)
                            @if(!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <select name="per_page" onchange="this.form.submit()" class="border border-gray-200 rounded-lg pl-3 pr-7 py-1 text-[13px] font-bold text-gray-700 focus:outline-none focus:border-[#8cb400] focus:ring-1 focus:ring-[#8cb400] transition-colors appearance-none bg-no-repeat cursor-pointer focus:ring-opacity-50 hover:border-gray-300" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%239ca3af\' stroke-width=\'2.5\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'/></svg>'); background-position: right 0.5rem center; background-size: 10px 10px;">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
                
                <!-- Custom Pagination using Laravel's Component -->
                <div class="flex items-center gap-2">
                    {{ $leads->onEachSide(1)->links('components.pagination') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeout = null;
    const searchInputs = document.querySelectorAll('input[name="search"]');
    
    // Check if we should auto-focus after reload
    const shouldFocus = sessionStorage.getItem('leads_search_focus');
    
    searchInputs.forEach(input => {
        // Restore focus if needed
        if (shouldFocus && input.value && input.offsetParent !== null) { // offsetParent check ensures it is the visible one (desktop/mobile)
            setTimeout(() => {
                input.focus();
                const len = input.value.length;
                input.setSelectionRange(len, len);
            }, 10); // slight delay to ensure render
        }

        input.addEventListener('input', function() {
            // Give user 600ms to type before submitting
            clearTimeout(timeout);
            
            // Mark that we are actively typing here
            sessionStorage.setItem('leads_search_focus', 'true');
            
            timeout = setTimeout(() => {
                this.closest('form').submit();
            }, 600); 
        });

        // Clear focus memory when clicking outside or blur
        input.addEventListener('blur', () => {
            // We use timeout so if the blur is caused by form submit, it won't clear immediately
            setTimeout(() => {
                sessionStorage.removeItem('leads_search_focus');
            }, 200);
        });
    });
});
</script>
@endsection
