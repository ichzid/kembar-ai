<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Login - Kembar AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --page-bg: #f6f6f2;
            --card-bg: #ffffff;
            --text-strong: #192235;
            --text-muted: #8d97ab;
            --text-soft: #b1b9c7;
            --olive: #8cb400;
            --olive-dark: #607507;
            --lime-soft: #f6fb76;
            --line: #cfd7bb;
            --border: #e8edf4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(201, 215, 162, 0.12), transparent 30%),
                radial-gradient(circle at bottom right, rgba(205, 221, 154, 0.12), transparent 28%),
                var(--page-bg);
            color: var(--text-strong);
        }

        .auth-card {
            border: 1px solid rgba(230, 235, 243, 0.95);
            box-shadow: 0 26px 60px rgba(31, 43, 64, 0.08);
        }

        .google-button {
            border: 1px solid #dce4ee;
            box-shadow: 0 8px 16px rgba(146, 162, 178, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .google-button:hover {
            transform: translateY(-1px);
            border-color: rgba(140, 180, 0, 0.45);
            box-shadow: 0 12px 24px rgba(112, 132, 59, 0.14);
        }

        .google-button:focus-visible {
            outline: 3px solid rgba(140, 180, 0, 0.18);
            outline-offset: 2px;
        }

        .google-button[disabled] {
            cursor: wait;
            opacity: 0.86;
            transform: none;
        }

        .check-icon {
            flex: 0 0 auto;
            width: 18px;
            height: 18px;
        }

        .decor-line {
            height: 1px;
            width: min(100%, 335px);
            background: linear-gradient(90deg, rgba(164, 177, 120, 0.75), rgba(164, 177, 120, 0.45));
        }

        .art-panel img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .art-canvas {
            position: relative;
            width: min(100%, 340px);
        }

        .copyright {
            color: #98a1b4;
        }

        .loading-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(111, 121, 145, 0.28);
            border-top-color: var(--olive);
            border-radius: 999px;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1023px) {
            .mobile-ornament {
                display: block;
            }
        }

        @media (min-width: 1024px) {
            .mobile-ornament {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen px-4 sm:px-6">
        <div class="mx-auto flex min-h-screen max-w-[1280px] flex-col">
            <main class="flex flex-1 items-center justify-center py-10 lg:py-14">
                <div class="grid w-full grid-cols-1 items-center gap-10 lg:grid-cols-[1fr_384px_1fr] lg:gap-6 mt-8 lg:mt-16">
                    <div class="hidden lg:flex lg:flex-col lg:gap-12 lg:pr-4">
                        <div class="art-panel flex flex-col items-center gap-8">
                            <div class="art-canvas h-[180px]">
                                <img
                                    src="{{ asset('images/auth/vector23.png') }}"
                                    alt=""
                                    aria-hidden="true"
                                    class="absolute left-[6px] top-[8px] w-[86px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <img
                                    src="{{ asset('images/auth/group8.png') }}"
                                    alt=""
                                    aria-hidden="true"
                                    class="absolute left-[90px] top-[58px] w-[72px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="decor-line"></div>
                        </div>

                        <div class="art-panel flex flex-col items-center gap-8">
                            <div class="art-canvas h-[182px]">
                                <img
                                    src="{{ asset('images/auth/group6.png') }}"
                                    alt=""
                                    aria-hidden="true"
                                    class="absolute left-[6px] top-[8px] w-[180px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="decor-line"></div>
                        </div>
                    </div>

                    <section class="mx-auto w-full max-w-[384px] translate-y-8 lg:translate-y-20">
                        <div class="mobile-ornament mx-auto mb-6 h-2 w-24 rounded-full bg-[rgba(140,180,0,0.16)]"></div>

                        <div class="auth-card rounded-[24px] bg-white px-6 py-8 sm:px-8 sm:py-9">
                            <header class="text-center">
                                <h1 class="text-[20px] font-extrabold tracking-[-0.02em] text-[var(--text-strong)] sm:text-[22px]">
                                    Selamat Datang
                                </h1>
                                <p class="mt-2 text-[14px] font-medium text-[var(--text-muted)]">
                                    Masuk untuk melanjutkan ke dashboard anda
                                </p>
                            </header>

                            @if (session('error'))
                                <div class="mt-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form id="googleLoginForm" action="{{ route('google.redirect') }}" method="GET" class="mt-6">
                                <button
                                    id="googleLoginButton"
                                    type="submit"
                                    class="google-button flex w-full items-center justify-center gap-2 rounded-[10px] bg-white px-4 py-3 text-[15px] font-semibold text-[#90AC22]"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M22.56 12.25C22.56 11.47 22.49 10.72 22.36 10H12V14.26H17.92C17.66 15.63 16.88 16.79 15.71 17.57V20.34H19.28C21.36 18.42 22.56 15.59 22.56 12.25Z" fill="#4285F4"/>
                                        <path d="M12 23C14.97 23 17.46 22.02 19.28 20.34L15.71 17.57C14.73 18.23 13.48 18.63 12 18.63C9.14 18.63 6.71 16.7 5.84 14.1H2.18V16.94C3.99 20.53 7.7 23 12 23Z" fill="#34A853"/>
                                        <path d="M5.84 14.09C5.62 13.43 5.49 12.73 5.49 12C5.49 11.27 5.62 10.57 5.84 9.91V7.07H2.18C1.43 8.55 1 10.22 1 12C1 13.78 1.43 15.45 2.18 16.93L5.84 14.09Z" fill="#FBBC05"/>
                                        <path d="M12 5.38C13.62 5.38 15.06 5.94 16.21 7.02L19.36 3.87C17.45 2.09 14.97 1 12 1C7.7 1 3.99 3.47 2.18 7.07L5.84 9.91C6.71 7.31 9.14 5.38 12 5.38Z" fill="#EA4335"/>
                                    </svg>
                                    <span class="google-button__label">Lanjutkan dengan Google</span>
                                </button>
                            </form>

                            <div class="mt-6 space-y-3.5">
                                <div class="flex items-center gap-3 text-[14px] font-medium text-[var(--text-muted)]">
                                    <svg class="check-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <circle cx="10" cy="10" r="8.25" stroke="#5A6476" stroke-width="1.5"/>
                                        <path d="M6.5 10.2L8.9 12.6L13.8 7.7" stroke="#5A6476" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Akses dashboard AI persona Anda</span>
                                </div>

                                <div class="flex items-center gap-3 text-[14px] font-medium text-[var(--text-muted)]">
                                    <svg class="check-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <circle cx="10" cy="10" r="8.25" stroke="#5A6476" stroke-width="1.5"/>
                                        <path d="M6.5 10.2L8.9 12.6L13.8 7.7" stroke="#5A6476" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Kelola Konten &amp; Pengaturan AI</span>
                                </div>

                                <div class="flex items-center gap-3 text-[14px] font-medium text-[var(--text-muted)]">
                                    <svg class="check-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <circle cx="10" cy="10" r="8.25" stroke="#5A6476" stroke-width="1.5"/>
                                        <path d="M6.5 10.2L8.9 12.6L13.8 7.7" stroke="#5A6476" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Monitor percakapan &amp; analytics</span>
                                </div>
                            </div>

                            <div class="relative mt-7">
                                <div class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-[#e6ebf1]"></div>
                                <div class="relative mx-auto w-fit bg-white px-4 text-[13px] font-semibold text-[var(--text-soft)]">
                                    Akses cepat &amp; aman
                                </div>
                            </div>

                            <p class="mt-7 text-center text-[13px] font-medium leading-6 text-[var(--text-muted)]">
                                Dengan melanjutkan, Anda menyetujui
                                <a href="#" class="font-semibold text-[#4f5b73] underline decoration-1 underline-offset-2">ketentuan layanan</a>
                                dan
                                <a href="#" class="font-semibold text-[#4f5b73] underline decoration-1 underline-offset-2">Kebijakan Privasi</a>
                                kami
                            </p>
                        </div>

                        <div class="mt-10 text-center">
                            <a href="/" class="inline-flex items-center gap-2 text-[14px] font-semibold text-[#3d4658] transition hover:text-[#111827]">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M12.5 5L7.5 10L12.5 15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Kembali ke Beranda</span>
                            </a>
                        </div>
                    </section>

                    <div class="hidden lg:flex lg:flex-col lg:gap-12 lg:pl-4">
                        <div class="art-panel flex flex-col items-center gap-8">
                            <div class="art-canvas h-[182px]">
                                <img
                                    src="{{ asset('images/auth/group7.png') }}"
                                    alt=""
                                    aria-hidden="true"
                                    class="absolute right-[8px] top-[10px] w-[235px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="decor-line"></div>
                        </div>

                        <div class="art-panel flex flex-col items-center gap-8">
                            <div class="art-canvas h-[182px]">
                                <img
                                    src="{{ asset('images/auth/group9.png') }}"
                                    alt=""
                                    aria-hidden="true"
                                    class="absolute left-[58px] top-[84px] w-[88px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="decor-line"></div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="pb-10 text-center text-[14px] font-medium copyright">
                Copyright@ 2026 by Kembar Ai
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('googleLoginForm');
            const button = document.getElementById('googleLoginButton');

            if (!form || !button) {
                return;
            }

            form.addEventListener('submit', function () {
                button.setAttribute('disabled', 'disabled');
                button.innerHTML = `
                    <span class="loading-spinner" aria-hidden="true"></span>
                    <span class="google-button__label">Menghubungkan...</span>
                `;
            });
        });
    </script>
</body>
</html>
