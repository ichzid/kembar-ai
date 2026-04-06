<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <title>@yield('title', 'Dashboard') - Kembar AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-display {
            font-family: 'Playfair Display', serif;
        }
        
        .luxury-gradient {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        }
        
        .gold-text {
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .elegant-shadow {
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.08);
        }
        
        .menu-item {
            transition: all 0.3s ease;
        }
        
        .menu-item:hover {
            background: rgba(212, 175, 55, 0.05);
            border-left: 3px solid #d4af37;
        }
        
        .menu-item.active {
            background: rgba(212, 175, 55, 0.1);
            border-left: 3px solid #d4af37;
            color: #1a1a1a;
            font-weight: 600;
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.12);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white">
    
    <!-- Mobile Menu Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
    
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Main Content -->
    <div class="md:ml-64 min-h-screen flex flex-col">
        <!-- Header -->
        @include('layouts.header')
        
        <!-- Content Area -->
        <main class="flex-1 p-4 md:p-8">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="document.getElementById('logoutModal').classList.add('hidden')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white rounded-[20px] shadow-xl w-full max-w-sm overflow-hidden transform transition-all relative pointer-events-auto">
                <!-- Close Button -->
                <button type="button" onclick="document.getElementById('logoutModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="p-8 text-center flex flex-col items-center">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-14 h-14 rounded-full border-[3px] border-[#da291c] mb-5">
                        <span class="text-[#da291c] text-3xl font-bold">!</span>
                    </div>
                    
                    <h3 class="text-[18px] font-bold text-[#111827] mb-8">Apakah anda ingin keluar?</h3>
                    
                    <div class="flex items-center justify-center gap-3 w-full px-2">
                        <button type="button" onclick="document.getElementById('logoutModal').classList.add('hidden')" class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-700 text-[14px] font-bold hover:bg-gray-50 transition-colors bg-white">
                            Batal
                        </button>
                        <button type="button" onclick="document.getElementById('logoutForm').submit()" class="px-5 py-2.5 rounded-lg bg-[#6a8b00] hover:bg-[#5b7800] text-white text-[14px] font-bold transition-colors shadow-sm">
                            Ya, Keluar!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Profile dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        const profileTrigger = document.getElementById('profileDropdownTrigger');
        const profileDropdown = document.getElementById('profileDropdown');
        
        // Toggle dropdown saat profile di-click
        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function(e) {
                if (!profileDropdown.contains(e.target) && !profileTrigger.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
            
            // Tutup dropdown saat tekan Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
        
        // Mobile menu toggle (existing code)
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        if (menuBtn && sidebar && overlay) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('hidden');
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
            });
        }
        
        // Close mobile menu when clicking menu items
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('open');
                    overlay.classList.add('hidden');
                }
            });
        });
    });
    </script>

    @stack('scripts')
</body>
</html>