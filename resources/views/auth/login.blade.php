<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Login - Kembar AI</title>
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
        
        .gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 50%, #d4af37 100%);
        }
        
        .gold-text {
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .elegant-shadow {
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.08);
        }
        
        .btn-google {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        
        .btn-google:hover {
            border-color: #d4af37;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.15);
            transform: translateY(-2px);
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .decoration-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37, transparent);
        }
        
        .shimmer {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0) 0%, rgba(212, 175, 55, 0.05) 50%, rgba(212, 175, 55, 0) 100%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(212, 175, 55, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-white pattern-dots min-h-screen flex items-center justify-center p-4">
    
    <!-- Login Container -->
    <div class="w-full max-w-md fade-in">
        <!-- Logo -->
        <div class="text-center mb-12">
            <a href="/" class="inline-block">
                <h1 class="text-4xl font-display font-bold text-gray-900 mb-2">
                    Kembar <span class="gold-text">AI</span>
                </h1>
            </a>
            <div class="decoration-line mx-auto mt-4"></div>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[2rem] elegant-shadow p-10 border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-display font-bold text-gray-900 mb-3">Selamat Datang</h2>
                <p class="text-gray-600">Masuk untuk melanjutkan ke dashboard Anda</p>
            </div>

            <!-- Google Login Button -->
            <button class="btn-google w-full bg-white px-6 py-4 rounded-2xl font-semibold text-gray-700 flex items-center justify-center space-x-3 mb-6">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                <span>Lanjutkan dengan Google</span>
            </button>

            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Akses cepat & aman</span>
                </div>
            </div>

            <!-- Features -->
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 luxury-gradient rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">Akses dashboard AI persona Anda</p>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 luxury-gradient rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">Kelola konten & pengaturan AI</p>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 luxury-gradient rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">Monitor percakapan & analytics</p>
                </div>
            </div>

            <!-- Terms -->
            <p class="text-xs text-gray-500 text-center mt-8 leading-relaxed">
                Dengan melanjutkan, Anda menyetujui <a href="#" class="text-gray-700 hover:text-gray-900 underline">Ketentuan Layanan</a> dan <a href="#" class="text-gray-700 hover:text-gray-900 underline">Kebijakan Privasi</a> kami
            </p>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="/" class="text-gray-600 hover:text-gray-900 transition inline-flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="fixed top-10 left-10 w-32 h-32 gold-gradient opacity-10 rounded-full blur-3xl shimmer"></div>
    <div class="fixed bottom-10 right-10 w-40 h-40 gold-gradient opacity-10 rounded-full blur-3xl shimmer"></div>

    <script>
        // Google Login Handler
        const googleBtn = document.querySelector('.btn-google');
        
        googleBtn.addEventListener('click', function() {
            // Tambahkan loading state
            this.disabled = true;
            this.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Menghubungkan...</span>
            `;
            
            // Simulasi Google OAuth redirect
            // Ganti dengan URL Google OAuth Anda yang sebenarnya
            setTimeout(() => {
                window.location.href = '/auth/google'; // Ganti dengan endpoint OAuth Anda
            }, 1000);
        });
    </script>

</body>
</html>