<aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-[#f8f9fa] border-r border-gray-100 z-50 transition-transform duration-300 ease-in-out flex flex-col">
    <!-- Logo -->
    <div class="h-[80px] px-6 flex items-center">
        <img src="{{ asset('images/logo/kembar-ai.png') }}" alt="Kembar AI" class="h-12 w-auto object-contain">
    </div>
    
    <!-- Navigation -->
    <nav class="px-5 py-4 flex-1 overflow-y-auto">
        <p class="px-3 text-xs font-semibold text-gray-500 mb-3 tracking-wide">Platform</p>
        <ul class="space-y-0.5">
            <li>
                <a href="{{ route('dashboard') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('dashboard') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">Overview</span>
                </a>
            </li>

            <li>
                <a href="{{ route('personas.index') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('personas.*') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('personas.*') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">Personalia</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('whatsapp.index') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('whatsapp.*') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('whatsapp.*') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">WhatsApp</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('leads.index') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('leads.*') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('leads.*') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">Leads</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('chats.index') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('chats.*') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('chats.*') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">Chat Logs</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('decision-inbox.index') }}" class="group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] transition-all duration-300 {{ request()->routeIs('decision-inbox.*') ? 'bg-[#8cb400] text-white font-medium shadow-md shadow-[#8cb400]/20' : 'text-gray-600 hover:bg-[#faffcc] hover:text-gray-900' }}">
                    <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm {{ request()->routeIs('decision-inbox.*') ? 'bg-white text-[#8cb400]' : 'bg-white text-[#8cb400] group-hover:bg-[#8cb400] group-hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-[14px]">Decision Inbox</span>
                </a>
            </li>
        </ul>
        
        <div class="mt-8 mb-4">
            <button type="button" onclick="document.getElementById('logoutModal').classList.remove('hidden')" class="w-full group flex items-center space-x-3 px-3 py-1.5 rounded-[14px] text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-all duration-300">
                <div class="flex-shrink-0 w-8 h-8 rounded-[10px] flex items-center justify-center transition-colors duration-300 shadow-sm bg-white text-[#8cb400] group-hover:bg-gray-200 group-hover:text-gray-900">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <span class="text-[14px]">Log Out</span>
            </button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>
    
    <!-- Bottom Menu -->
    <div class="mt-auto px-6 py-8">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo/ai-lab.png') }}" alt="AI-Lab" class="h-8 w-8 object-contain">
            <div class="flex flex-col">
                <span class="text-sm font-bold text-gray-900">AI-Lab</span>
                <span class="text-[10px] text-gray-500">PT. Creative Future Lab</span>
            </div>
        </div>
    </div>
</aside>
