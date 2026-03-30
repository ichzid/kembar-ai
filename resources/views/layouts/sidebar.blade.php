<aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 z-50 transition-transform duration-300 ease-in-out">
    <!-- Logo -->
    <div class="h-[73px] px-6 flex items-center border-b border-gray-200">
        <h1 class="text-2xl font-display font-bold text-gray-900">
            Kembar <span class="gold-text">AI</span>
        </h1>
    </div>
    
    <!-- Navigation -->
    <nav class="p-4 overflow-y-auto" style="height: calc(100vh - 73px);">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Overview</span>
                </a>
            </li>

            <li>
                <a href="{{ route('personas.index') }}" class="menu-item {{ request()->routeIs('personas.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Personalia</span>
                </a>
            </li>
            {{-- Knowledge Base & Settings integrated into Personalia for MVP --}}
            {{-- 
            <li>
                <a href="#" class="menu-item flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg opacity-50 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Knowledge Base</span>
                </a>
            </li>
            --}}
            <li>
                <a href="{{ route('whatsapp.index') }}" class="menu-item {{ request()->routeIs('whatsapp.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span>WhatsApp</span>
                </a>
            </li>
            <li>
                <a href="{{ route('leads.index') }}" class="menu-item {{ request()->routeIs('leads.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Leads</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chats.index') }}" class="menu-item {{ request()->routeIs('chats.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <span>Chat Logs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('decision-inbox.index') }}" class="menu-item {{ request()->routeIs('decision-inbox.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span>Decision Inbox</span>
                </a>
            </li>
        </ul>
        
        <!-- Divider -->
        <div class="my-6 border-t border-gray-200"></div>
        
        <!-- Bottom Menu -->
        <ul class="space-y-1">

            <li>
                <a href="{{ route('account.index') }}" class="menu-item {{ request()->routeIs('account.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.89 3.31.876 2.42 2.42a1.724 1.724 0 001.065 2.572c1.757.426 1.757 2.924 0 3.35a1.724 1.724 0 00-1.065 2.572c.89 1.543-.877 3.31-2.42 2.42a1.724 1.724 0 00-2.573 1.065c-.426 1.757-2.924 1.757-3.35 0a1.724 1.724 0 00-2.572-1.065c-1.543.89-3.31-.877-2.42-2.42a1.724 1.724 0 00-1.066-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.572c-.89-1.544.877-3.31 2.42-2.42.996.575 2.248.25 2.572-1.066z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Pengaturan</span>
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="menu-item w-full flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
