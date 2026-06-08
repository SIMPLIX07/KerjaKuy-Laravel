<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - KerjaKuy</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "error": "#ba1a1a",
                      "primary-container": "#112d42",
                      "outline": "#73777d",
                      "on-error-container": "#93000a",
                      "outline-variant": "#c3c7cd",
                      "on-tertiary": "#ffffff",
                      "on-secondary-fixed": "#00201f",
                      "on-primary-fixed": "#001d31",
                      "on-background": "#181c1e",
                      "surface-bright": "#f7fafc",
                      "on-primary-fixed-variant": "#2f495f",
                      "on-tertiary-fixed": "#00201d",
                      "on-secondary-fixed-variant": "#00504e",
                      "secondary": "#006a68",
                      "surface-variant": "#e0e3e5",
                      "secondary-fixed": "#94f2f0",
                      "on-primary": "#ffffff",
                      "surface-dim": "#d7dadc",
                      "on-secondary-container": "#006e6d",
                      "tertiary-fixed-dim": "#5adace",
                      "surface-container-highest": "#e0e3e5",
                      "on-surface-variant": "#43474c",
                      "tertiary": "#001a18",
                      "inverse-on-surface": "#eef1f3",
                      "background": "#f7fafc",
                      "surface-container": "#ebeef0",
                      "primary": "#00182a",
                      "secondary-container": "#91f0ed",
                      "on-secondary": "#ffffff",
                      "primary-fixed-dim": "#afc9e4",
                      "primary-fixed": "#cde5ff",
                      "on-tertiary-container": "#00a499",
                      "surface-tint": "#476178",
                      "tertiary-container": "#00312d",
                      "on-primary-container": "#7b95ae",
                      "surface-container-high": "#e5e9eb",
                      "on-error": "#ffffff",
                      "inverse-surface": "#2d3133",
                      "tertiary-fixed": "#79f7ea",
                      "error-container": "#ffdad6",
                      "on-surface": "#181c1e",
                      "surface-container-lowest": "#ffffff",
                      "surface": "#f7fafc",
                      "secondary-fixed-dim": "#77d6d3",
                      "on-tertiary-fixed-variant": "#00504a",
                      "inverse-primary": "#afc9e4",
                      "surface-container-low": "#f1f4f6"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "margin-mobile": "16px",
                      "base": "4px",
                      "xs": "8px",
                      "xl": "64px",
                      "lg": "40px",
                      "margin-desktop": "48px",
                      "sm": "16px",
                      "md": "24px",
                      "gutter": "24px"
              },
              "fontFamily": {
                      "headline-lg": ["Manrope"],
                      "headline-md": ["Manrope"],
                      "headline-xl": ["Manrope"],
                      "body-md": ["Inter"],
                      "label-md": ["Inter"],
                      "headline-lg-mobile": ["Manrope"],
                      "body-lg": ["Inter"],
                      "label-sm": ["Inter"],
                      "body-sm": ["Inter"]
              },
              "fontSize": {
                      "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                      "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                      "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                      "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                      "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                      "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                      "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
              }
            },
          },
        }
    </script>
    <style>
        .gradient-mesh {
            background-color: #00182a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(177, 68%, 39%, 0.45) 0px, transparent 50%),
                radial-gradient(at 100% 100%, hsla(177, 68%, 39%, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(208, 100%, 8%, 0.1) 0px, transparent 50%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body class="bg-background font-body-md text-on-surface">
    <!-- TopNavBar -->
    <header class="bg-primary dark:bg-primary-container shadow-md sticky top-0 z-50">
    </header>
    
    <main class="min-h-[calc(100vh-140px)] flex items-center justify-center gradient-mesh relative overflow-hidden" style="background-position: 6.36px 2.785px;">
        <!-- Floating Elements for Atmosphere -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary-container/20 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl w-full px-margin-desktop py-xl grid grid-cols-1 md:grid-cols-2 gap-xl items-center relative z-10">
            <!-- Left Content: Hero Text -->
            <div class="hidden md:block space-y-md text-on-primary">
                <h1 class="font-headline-xl text-headline-xl leading-tight text-white">
                    Selamat Datang Kembali di <span class="text-secondary-fixed font-bold">KerjaKuy</span>
                </h1>
                <p class="font-body-lg text-body-lg text-on-primary-container max-w-md opacity-90">
                    Temukan peluang karir terbaikmu hari ini. Hubungkan dirimu dengan ribuan perusahaan ternama dengan kecepatan tinggi.
                </p>
                <div class="pt-md flex gap-sm items-center text-secondary-fixed">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">speed</span>
                    <span class="font-label-md">Proses lamaran 2x lebih cepat</span>
                </div>
            </div>
            
            <!-- Right Content: Login Card -->
            <div class="flex justify-center md:justify-end">
                <div class="glass-card w-full max-w-md p-md md:p-lg rounded-xl shadow-2xl">
                    <div class="text-center md:text-left mb-lg">
                        <h2 class="font-headline-lg text-headline-lg text-primary mb-xs">Masuk ke Akun Pelamar</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Lanjutkan perjalanan karir Anda sekarang.</p>
                    </div>
                    
                    <!-- Alerts -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 rounded-lg bg-error-container text-on-error-container text-body-sm font-semibold border border-error/20 flex flex-col gap-1">
                            @foreach ($errors->all() as $err)
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[16px] text-error">error</span>
                                    <span>{{ $err }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-lg bg-secondary-container text-on-secondary-container text-body-sm font-semibold border border-secondary/20 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">task_alt</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('login.pelamar') }}" method="POST" class="space-y-md">
                        @csrf
                        
                        <div class="space-y-xs">
                            <label class="font-label-md text-on-surface-variant block">Username</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline group-focus-within:text-secondary transition-colors">person</span>
                                <input name="username" id="usn" class="w-full pl-xl pr-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all placeholder:text-outline-variant" placeholder="Masukkan Username" type="text" value="{{ old('username') }}" required>
                            </div>
                        </div>
                        
                        <div class="space-y-xs">
                            <label class="font-label-md text-on-surface-variant block">Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline group-focus-within:text-secondary transition-colors">lock</span>
                                <input name="password" class="w-full pl-xl pr-xl py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all placeholder:text-outline-variant" id="passwordInput" placeholder="Masukkan Password" type="password" required>
                                <button class="absolute right-sm top-1/2 -translate-y-1/2 text-outline hover:text-secondary" onclick="togglePassword()" type="button">
                                    <span class="material-symbols-outlined" id="passIcon">visibility</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between py-xs">
                            <label class="flex items-center gap-xs cursor-pointer">
                                <input class="w-4 h-4 rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox">
                                <span class="font-body-sm text-on-surface-variant">Ingat Saya</span>
                            </label>
                            <a class="font-label-sm text-secondary hover:underline" href="#">Lupa kata sandi?</a>
                        </div>
                        
                        <button class="w-full bg-secondary text-on-secondary py-sm rounded-lg font-headline-md shadow-md hover:bg-secondary/90 hover:shadow-lg transition-all active:scale-95 duration-200" type="submit">
                            Masuk
                        </button>
                    </form>
                    
                    <div class="mt-lg flex flex-col items-center gap-md">
                        <div class="relative w-full text-center">
                            <span class="bg-surface-container-lowest px-md text-body-sm text-outline relative z-10">Atau</span>
                            <div class="absolute top-1/2 w-full h-px bg-outline-variant -z-0"></div>
                        </div>
                        <p class="font-body-sm text-on-surface-variant">
                            Belum punya akun? <a class="text-secondary font-bold hover:underline" href="/register/pelamar">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-surface-container-lowest dark:bg-inverse-surface border-t border-outline-variant dark:border-outline">
        <div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-lg w-full max-w-7xl mx-auto">
            <div class="mb-md md:mb-0 text-center md:text-left">
                <span class="font-headline-sm text-headline-sm font-black text-primary dark:text-primary-fixed block mb-base">KerjaKuy</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant dark:text-surface-variant">© 2024 KerjaKuy. Hubungkan Karir Anda dengan Kecepatan.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-md">
                <a class="text-body-sm text-on-surface-variant dark:text-surface-variant hover:text-secondary transition-colors" href="#">Tentang Kami</a>
                <a class="text-body-sm text-on-surface-variant dark:text-surface-variant hover:text-secondary transition-colors" href="#">Pusat Bantuan</a>
                <a class="text-body-sm text-on-surface-variant dark:text-surface-variant hover:text-secondary transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-body-sm text-on-surface-variant dark:text-surface-variant hover:text-secondary transition-colors" href="#">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </footer>
    
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('passIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Add a subtle parallax effect on mouse move
        document.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
            document.querySelector('.gradient-mesh').style.backgroundPosition = `${moveX}px ${moveY}px`;
        });
    </script>
</body>
</html>
