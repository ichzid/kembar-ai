<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <title>Kembar AI - Your Digital Twin. Trained by You. Trusted by Your Audience.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-display {
            font-family: 'Playfair Display', serif;
        }
        
        .lime-gradient {
            background: linear-gradient(135deg, #8cb400 0%, #ebf5c7 50%, #8cb400 100%);
        }
        
        .lime-text {
            color: #8cb400;
        }
        
        .text-\\[\\#8cb400\\] {
            /* Fix for accidental regex replacement */
            color: #8cb400;
        }
        
        .elegant-shadow {
            box-shadow: 0 10px 40px rgba(140, 180, 0, 0.08); /* changed to lime */
        }
        
        .card-luxury {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(140, 180, 0, 0.1); /* changed to lime */
        }
        
        .card-luxury:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 60px rgba(140, 180, 0, 0.15); /* changed to lime */
            border-color: rgba(140, 180, 0, 0.3); /* changed to lime */
        }
        
        .btn-primary {
            background: #8cb400;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
        }
        
        .btn-primary:hover {
            background: #7a9d00;
            box-shadow: 0 10px 30px rgba(140, 180, 0, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            border: 2px solid #8cb400;
            color: #8cb400;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .btn-secondary:hover {
            background: #8cb400;
            color: white;
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
            background: linear-gradient(90deg, #8cb400, transparent);
        }
        
        .shimmer {
            background: linear-gradient(90deg, rgba(140, 180, 0, 0) 0%, rgba(140, 180, 0, 0.1) 50%, rgba(140, 180, 0, 0) 100%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .elegant-border {
            position: relative;
        }
        
        .elegant-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #8cb400, transparent);
        }
    </style>
</head>
<body class="bg-white">
    
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-xl z-50 border-b border-gray-100 elegant-shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <h1 class="text-3xl font-display font-bold text-gray-900">Kembar <span class="text-[#8cb400]">AI</span></h1>
                </div>
                <div class="hidden md:flex space-x-10">
                    <a href="#features" class="text-gray-700 hover:text-gray-900 font-medium transition">Fitur</a>
                    <a href="#how-it-works" class="text-gray-700 hover:text-gray-900 font-medium transition">Cara Kerja</a>
                    <a href="#pricing" class="text-gray-700 hover:text-gray-900 font-medium transition">Harga</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-gray-900 font-medium transition">Testimoni</a>
                    <a href="#faq" class="text-gray-700 hover:text-gray-900 font-medium transition">FAQ</a>
                </div>
                <a href="/login" class="btn-primary text-white px-8 py-3 rounded-full font-semibold">
                    Buat Kembaran Saya
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-6xl md:text-7xl font-display font-bold text-gray-900 mb-8 leading-tight">
                    Kloning Dirimu ke AI.<br/>
                    <span class="text-[#8cb400]">Biarkan Kembaranmu Hadir</span><br/>
                    Saat Kamu Tidak Bisa.
                </h2>
                <div class="decoration-line mx-auto mb-8"></div>
                <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-4xl mx-auto leading-relaxed">
                    Kembar AI adalah AI agent yang dilatih langsung dari dirimu, berbicara dengan gaya, nilai, dan batasan yang kamu tentukan, untuk lebih dekat dengan audiens, menangkap peluang, dan menyaring kerjasama secara otomatis.
                </p>
                
                <!-- Trust Signals -->
                <div class="flex flex-wrap justify-center gap-6 mb-12 text-sm text-gray-600">
                    <div class="flex items-center">
                        <span class="mr-2">✓</span>
                        <span>WhatsApp API Resmi Meta</span>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2">✓</span>
                        <span>AI Disclosure & Guardrails</span>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2">✓</span>
                        <span>Data Milik Anda Sepenuhnya</span>
                    </div>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-5 justify-center">
                    <a href="/login" class="btn-primary text-white px-12 py-5 rounded-full font-bold text-lg inline-block">
                        Buat Kembaran Saya
                    </a>
                    <button class="btn-secondary text-gray-900 px-12 py-5 rounded-full font-bold text-lg">
                        Lihat Demo 60 Detik
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution Section (Enhanced) -->
    <section class="py-28 bg-gradient-to-b from-gray-50 to-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-40">
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-[#f4fadc] blur-3xl filter opacity-30"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] rounded-full bg-gray-100 blur-3xl filter opacity-30"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 fade-in">
                <h3 class="text-5xl md:text-7xl font-display font-bold text-gray-900 mb-8 leading-tight">
                    Inilah <span class="text-[#8cb400]">Kembaran Digital</span> Kamu.
                </h3>
                <div class="decoration-line mx-auto mb-8"></div>
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed font-light">
                    Kembar AI bukan chatbot. Bukan auto-reply. Dan bukan AI yang berbicara sembarangan.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="space-y-8">
                    <div class="bg-gradient-to-r from-gray-50 to-white p-8 rounded-3xl border border-gray-100 card-luxury group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-6">
                                <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#8cb400]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#7a9d00] transition-colors">Memahami Cara Kamu Berpikir</h4>
                                <p class="text-gray-600">Bukan sekadar menjawab, tapi berpikir dengan logika dan nilai yang kamu miliki.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-white p-8 rounded-3xl border border-gray-100 card-luxury group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-6">
                                <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#8cb400]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#7a9d00] transition-colors">Berbicara dengan Suara Personalmu</h4>
                                <p class="text-gray-600">Tone, gaya bahasa, dan sapaan khasmu tetap terjaga dalam setiap pesan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-gradient-to-r from-gray-50 to-white p-8 rounded-3xl border border-gray-100 card-luxury group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-6">
                                <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#8cb400]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#7a9d00] transition-colors">Tahu Kapan Harus Menjawab</h4>
                                <p class="text-gray-600">Cerdas memilah mana yang perlu dijawab, mana yang harus diteruskan, dan mana yang harus berhenti.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-white p-8 rounded-3xl border border-gray-100 card-luxury group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-6">
                                <div class="w-14 h-14 rounded-full bg-gray-900 flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-[#8cb400]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#7a9d00] transition-colors">Bekerja 24/7 Tanpa Merusak Reputasi</h4>
                                <p class="text-gray-600">Melayani audiens kapan saja dengan standar keamanan brand yang ketat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-16 fade-in">
                <div class="inline-block p-1 rounded-full bg-gradient-to-r from-gray-200 to-gray-100">
                    <div class="bg-white rounded-full px-8 py-4">
                        <p class="text-xl font-display font-medium text-gray-800">
                            Bukan untuk menggantikanmu. Tapi untuk <span class="text-[#8cb400] font-bold">mewakilimu dengan cara yang bertanggung jawab</span>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Testimonials moved below FAQ -->

    <!-- Features Section -->
    <section id="features" class="py-28 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h3 class="text-5xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Fitur Utama <span class="text-[#8cb400]">Kembar AI</span>
                </h3>
                <div class="decoration-line mx-auto mb-8"></div>
                <p class="text-xl text-gray-600">
                    Dirancang untuk personal brand yang serius tentang reputasi, kontrol, dan kepercayaan.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- AI Digital Twin -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">AI Digital Twin</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Dilatih dari konten & percakapan langsung</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Gaya bicara, struktur jawaban, dan nilai konsisten</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Terasa personal, bukan generik</span>
                        </li>
                    </ul>
                </div>

                <!-- Static & Dynamic Training -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">Static & Dynamic Training</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Pengaturan terstruktur (tone, batasan, izin)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Training lewat ngobrol untuk penyempurnaan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Anti drift & anti halusinasi</span>
                        </li>
                    </ul>
                </div>

                <!-- Lead Capture Control -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">Lead Capture Control</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Berbasis checkbox (opt-in)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>AI hanya menggali data yang diizinkan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Pendekatan persuasif & kontekstual</span>
                        </li>
                    </ul>
                </div>

                <!-- Decision Inbox -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">Decision Inbox</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Deteksi otomatis kerjasama & urgensi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Ringkasan peluang siap review</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Satu inbox untuk semua keputusan penting</span>
                        </li>
                    </ul>
                </div>

                <!-- Brand Safety & Disclosure -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">Brand Safety & Disclosure</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>AI selalu mengaku sebagai AI representative</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Topik sensitif dibatasi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Mode aman untuk reputasi publik</span>
                        </li>
                    </ul>
                </div>

                <!-- WhatsApp Resmi -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">WhatsApp Resmi</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Menggunakan WhatsApp API resmi Meta</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Stabil, aman, dan scalable</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Cocok untuk audiens besar</span>
                        </li>
                    </ul>
                </div>

                <!-- Data Ownership -->
                <div class="bg-white p-10 rounded-[2.5rem] card-luxury md:col-span-1 lg:col-span-1 lg:col-start-2 text-center">
                    <h4 class="text-2xl font-display font-bold text-gray-900 mb-4">Data Ownership</h4>
                    <ul class="space-y-3 text-gray-600 inline-block text-left">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Data audiens milik Anda</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Bisa diekspor kapan saja</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Tidak dikunci di platform</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center mt-16 fade-in">
                <div class="inline-block p-1 rounded-full bg-gradient-to-r from-gray-200 to-gray-100">
                    <div class="bg-white rounded-full px-8 py-4">
                        <p class="text-xl font-display font-medium text-gray-800">
                            Bukan sekadar AI yang pintar. Tapi <span class="text-[#8cb400] font-bold">AI yang tahu batas</span>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-28 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h3 class="text-5xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Cara Kerja <span class="text-[#8cb400]">Kembar AI</span>
                </h3>
                <div class="decoration-line mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Bangun digital twin yang berbicara atas namamu dengan kontrol penuh, aman, dan terstruktur.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Step 1 -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full lime-gradient flex items-center justify-center text-white text-2xl font-bold mr-4">1</div>
                        <h4 class="text-3xl font-display font-bold text-gray-900">Bangun Kembaranmu</h4>
                    </div>
                    <p class="text-lg text-gray-700 mb-4">Latih AI dengan dua cara:</p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><strong>Statis:</strong> pilih gaya bicara, batasan, dan izin data</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span><strong>Dinamis:</strong> ajari AI lewat percakapan langsung</span>
                        </li>
                    </ul>
                    <p class="text-gray-700 mt-4">
                        Kembar AI belajar dari konten dan koreksimu, bukan dari asumsi AI.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full lime-gradient flex items-center justify-center text-white text-2xl font-bold mr-4">2</div>
                        <h4 class="text-3xl font-display font-bold text-gray-900">Kembar AI Berbicara untukmu</h4>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Audiens menghubungi lewat WhatsApp resmi. Kembar AI menjawab dengan suara dan nilai yang konsisten.
                    </p>
                    <p class="text-gray-700 font-semibold">
                        AI selalu transparan sebagai AI representative, bukan berpura-pura menjadi kamu.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full lime-gradient flex items-center justify-center text-white text-2xl font-bold mr-4">3</div>
                        <h4 class="text-3xl font-display font-bold text-gray-900">Data Ditangkap Secara Alami</h4>
                    </div>
                    <p class="text-gray-700 mb-4">Kembar AI mengenal audiens secara bertahap:</p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Nama</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Minat</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mr-2">•</span>
                            <span>Konteks</span>
                        </li>
                    </ul>
                    <p class="text-gray-700 mt-4">
                        Tanpa form. Tanpa interogasi. Hanya sejauh yang kamu izinkan.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full lime-gradient flex items-center justify-center text-white text-2xl font-bold mr-4">4</div>
                        <h4 class="text-3xl font-display font-bold text-gray-900">Keputusan Tetap di Tanganmu</h4>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Kerjasama, urgensi, dan hal penting dirangkum otomatis ke <strong>Decision Inbox</strong>.
                    </p>
                    <p class="text-gray-700">
                        Kamu tidak perlu membaca semua chat. Cukup review dan memutuskan.
                    </p>
                </div>
            </div>

            <div class="text-center mt-16 fade-in">
                <div class="inline-block p-1 rounded-full bg-gradient-to-r from-gray-200 to-gray-100">
                    <div class="bg-white rounded-full px-8 py-4">
                        <p class="text-xl font-display font-medium text-gray-800">
                            Kamu tetap menjadi pusat keputusan. <span class="text-[#8cb400] font-bold">Kembar AI mengurus sisanya</span>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-28 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h3 class="text-5xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Pilih Skala yang Sesuai<br/>
                    <span class="text-[#8cb400]">dengan Audiensmu.</span>
                </h3>
                <div class="decoration-line mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Semua paket Kembar AI mendapatkan fitur yang sama. Perbedaannya hanya pada seberapa banyak audiens yang ingin kamu layani setiap hari.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Starter Package -->
                <div class="bg-gradient-to-br from-green-50 to-white p-10 rounded-[2.5rem] card-luxury border-2 border-green-100">
                    <h4 class="text-3xl font-display font-bold text-gray-900 mb-3">Starter</h4>
                    <p class="text-gray-600 mb-6">Untuk personal brand dengan audiens yang mulai aktif</p>
                    
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Estimasi kapasitas:</p>
                        <p class="text-2xl font-bold text-gray-900">± 30–50 audiens chat/hari</p>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Cocok untuk:</p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Creator & expert dengan interaksi moderat</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Public figure yang ingin mulai mengurangi beban DM</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Termasuk fitur lengkap:</p>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>AI Digital Twin (clone personal)</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Static & Dynamic Training</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>WhatsApp API resmi Meta (1 nomor)</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Lead capture berbasis izin</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Decision Inbox</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Brand safety & AI disclosure</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Dashboard & data export</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <p class="text-4xl font-display font-bold text-gray-900">Rp 1.500.000<span class="text-lg text-gray-500 font-normal">/bulan</span></p>
                    </div>
                    
                    <a href="/login" class="block w-full btn-primary text-white px-8 py-4 rounded-full font-bold text-center">
                        Buat Kembaran Saya
                    </a>
                </div>

                <!-- Professional Package -->
                <div class="bg-gradient-to-br from-blue-50 to-white p-10 rounded-[2.5rem] card-luxury border-2 border-blue-200 transform scale-105 shadow-2xl">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-bold">
                        PALING POPULER
                    </div>
                    <h4 class="text-3xl font-display font-bold text-gray-900 mb-3">Professional</h4>
                    <p class="text-gray-600 mb-6">Untuk public figure dengan audiens aktif setiap hari</p>
                    
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Estimasi kapasitas:</p>
                        <p class="text-2xl font-bold text-gray-900">± 100–150 audiens chat/hari</p>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Cocok untuk:</p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Influencer aktif</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Educator & coach dengan komunitas besar</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Founder dengan personal brand kuat</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Termasuk fitur lengkap:</p>
                        <p class="text-gray-600 text-sm italic">(Sama persis dengan Starter, tanpa batasan fitur)</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <p class="text-4xl font-display font-bold text-gray-900">Rp 3.500.000<span class="text-lg text-gray-500 font-normal">/bulan</span></p>
                    </div>
                    
                    <a href="/login" class="block w-full btn-primary text-white px-8 py-4 rounded-full font-bold text-center">
                        Buat Kembaran Saya
                    </a>
                </div>

                <!-- Elite Package -->
                <div class="bg-gradient-to-br from-purple-50 to-white p-10 rounded-[2.5rem] card-luxury border-2 border-purple-100">
                    <h4 class="text-3xl font-display font-bold text-gray-900 mb-3">Elite</h4>
                    <p class="text-gray-600 mb-6">Untuk public figure besar & traffic tinggi</p>
                    
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Estimasi kapasitas:</p>
                        <p class="text-2xl font-bold text-gray-900">300+ audiens chat/hari</p>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Cocok untuk:</p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Artis & tokoh publik</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Personal brand dengan exposure tinggi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">•</span>
                                <span>Agency & manajemen</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Termasuk fitur lengkap:</p>
                        <p class="text-gray-600 text-sm italic mb-3">(Sama persis dengan paket lainnya)</p>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Tambahan:</p>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Priority support</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">✓</span>
                                <span>Custom quota (jika dibutuhkan)</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <p class="text-4xl font-display font-bold text-gray-900">Rp 7.500.000<span class="text-lg text-gray-500 font-normal">/bulan</span></p>
                    </div>
                    
                    <a href="/login" class="block w-full btn-primary text-white px-8 py-4 rounded-full font-bold text-center">
                        Buat Kembaran Saya
                    </a>
                </div>
            </div>

            <div class="text-center mt-16 mb-16 fade-in">
                <div class="inline-block p-1 rounded-full bg-gradient-to-r from-gray-200 to-gray-100">
                    <div class="bg-white rounded-full px-8 py-4">
                        <p class="text-xl font-display font-medium text-gray-800">
                            Investasi kecil. <span class="text-[#8cb400] font-bold">Ketenangan besar</span>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CEO Quote -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-gray-50 to-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100 text-center">
                    <p class="text-2xl font-display italic text-gray-800 mb-8 leading-relaxed">
                        "Membangun Kembar AI bukan tentang menggantikan manusia. Tapi tentang membebaskan manusia untuk melakukan hal yang hanya bisa dilakukan manusia: berkarya, berpikir, dan hidup."
                    </p>
                    <div class="flex items-center justify-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden">
                            <!-- Placeholder avatar -->
                            <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-gray-900">Miftah Fadli</p>
                            <p class="text-sm text-gray-500">CEO AI Lab</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-28 bg-gradient-to-b from-gray-50 to-gray-100" x-data="{ active: null }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-6">
                    Pertanyaan Umum
                </h3>
                <div class="decoration-line mx-auto"></div>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 1 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 1 ? null : 1" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Apakah Kembar AI aman untuk data saya?</span>
                        <span class="transform transition-transform duration-200" :class="active === 1 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Sangat aman. Data Anda adalah milik Anda sepenuhnya. Kami menggunakan enkripsi standar industri dan tidak pernah membagikan data Anda kepada pihak ketiga tanpa izin.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 2 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 2 ? null : 2" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Apakah saya perlu keahlian teknis?</span>
                        <span class="transform transition-transform duration-200" :class="active === 2 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Tidak sama sekali. Kembar AI dirancang agar mudah digunakan oleh siapa saja. Anda hanya perlu mengatur preferensi dan AI akan bekerja untuk Anda.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 3 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 3 ? null : 3" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Bisakah saya membatalkan langganan kapan saja?</span>
                        <span class="transform transition-transform duration-200" :class="active === 3 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Ya, Anda dapat membatalkan langganan kapan saja tanpa biaya tersembunyi. Akses Anda akan tetap aktif hingga akhir periode penagihan.
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 4 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 4 ? null : 4" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Apakah ada biaya tambahan untuk WhatsApp?</span>
                        <span class="transform transition-transform duration-200" :class="active === 4 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 4" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Harga paket sudah mencakup platform Kembar AI. Namun, biaya percakapan WhatsApp (WhatsApp Business API) dibayarkan langsung ke Meta sesuai penggunaan. Kami akan membantu Anda mengestimasikan biayanya.
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 5 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 5 ? null : 5" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Butuh bantuan lebih lanjut?</span>
                        <span class="transform transition-transform duration-200" :class="active === 5 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 5" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Tim support kami siap membantu Anda menjawab pertanyaan teknis maupun non-teknis.
                        <div class="mt-3">
                            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700">Hubungi Support &rarr;</a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300" :class="active === 6 ? 'shadow-lg ring-1 ring-gray-200' : ''">
                    <button @click="active = active === 6 ? null : 6" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-900">Apakah saya perlu asisten setelah memakai ini?</span>
                        <span class="transform transition-transform duration-200" :class="active === 6 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === 6" x-collapse class="p-6 pt-0 text-gray-600 leading-relaxed">
                        Banyak pengguna mengurangi kebutuhan screening manual secara drastis. Namun keputusan akhir tetap di tangan Anda.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-28 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <p class="text-xl text-gray-700 mb-6 leading-relaxed italic">
                        "Yang paling terasa itu tenang. DM tetap jalan, audiens tetap dilayani, tapi kepala saya nggak penuh lagi."
                    </p>
                    <p class="text-gray-600 font-semibold">— Public Figure & Entrepreneur</p>
                </div>
                
                <div class="bg-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <p class="text-xl text-gray-700 mb-6 leading-relaxed italic">
                        "Awalnya saya takut AI terdengar kaku. Ternyata justru terasa seperti saya sendiri yang menjawab."
                    </p>
                    <p class="text-gray-600 font-semibold">— Coach & Content Creator</p>
                </div>
                
                <div class="bg-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <p class="text-xl text-gray-700 mb-6 leading-relaxed italic">
                        "Biasanya kerjasama masuk acak dan tenggelam. Sekarang semuanya dirangkum. Saya tinggal pilih mana yang mau saya ambil."
                    </p>
                    <p class="text-gray-600 font-semibold">— Influencer & Brand Partner</p>
                </div>
                
                <div class="bg-white p-12 rounded-[2.5rem] elegant-shadow border border-gray-100">
                    <p class="text-xl text-gray-700 mb-6 leading-relaxed italic">
                        "Saya tidak ingin AI menggantikan saya. Saya ingin AI menjaga suara saya. Dan di sini itu kejaga."
                    </p>
                    <p class="text-gray-600 font-semibold">— Educator & Public Speaker</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-28 bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-5xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
                Saat Kamu Offline,<br/>
                <span class="text-[#8cb400]">Kembaranmu Tetap Hadir.</span>
            </h3>
            <div class="decoration-line mx-auto mb-8"></div>
            <p class="text-xl text-gray-600 mb-12 leading-relaxed">
                Bangun Kembar AI yang berbicara atas namamu — dengan cara yang kamu kontrol dan kamu banggakan.
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="/login" class="btn-primary text-white px-12 py-5 rounded-full font-bold text-lg inline-block">
                    Buat Kembaran Saya Sekarang
                </a>
                <button class="btn-secondary text-gray-900 px-12 py-5 rounded-full font-bold text-lg">
                    Hubungi Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16 elegant-border">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h4 class="text-white font-display font-bold text-2xl mb-6">
                        Kembar <span class="text-[#8cb400]">AI</span>
                    </h4>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Digital Twin for Human-Centered Personal Brands
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-6 text-lg">Produk</h5>
                    <ul class="space-y-3">
                        <li><a href="#features" class="hover:text-white transition text-gray-400">Fitur</a></li>
                        <li><a href="#pricing" class="hover:text-white transition text-gray-400">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Demo</a></li>
                        <li><a href="#faq" class="hover:text-white transition text-gray-400">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-6 text-lg">Perusahaan</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition text-gray-400">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-6 text-lg">Legal</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition text-gray-400">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition text-gray-400">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-500 mb-4 md:mb-0">
                    &copy; 2024 Kembar AI. All rights reserved.
                </p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-500 hover:text-white transition">Bantuan</a>
                    <a href="#" class="text-gray-500 hover:text-white transition">Status</a>
                    <a href="#" class="text-gray-500 hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
