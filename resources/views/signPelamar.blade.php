<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up | KerjaYuk - Elevate Your Career</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "inverse-on-surface": "#eef1f3",
                      "primary-container": "#112d42",
                      "surface-container": "#ebeef0",
                      "on-primary-container": "#7b95ae",
                      "on-secondary": "#ffffff",
                      "on-secondary-fixed-variant": "#00504e",
                      "outline": "#73777d",
                      "on-tertiary-container": "#00a499",
                      "on-surface": "#181c1e",
                      "tertiary": "#001a18",
                      "on-surface-variant": "#43474c",
                      "on-tertiary-fixed": "#00201d",
                      "surface-container-low": "#f1f4f6",
                      "outline-variant": "#c3c7cd",
                      "inverse-primary": "#afc9e4",
                      "tertiary-fixed": "#79f7ea",
                      "primary-fixed-dim": "#afc9e4",
                      "inverse-surface": "#2d3133",
                      "surface": "#f7fafc",
                      "secondary-container": "#91f0ed",
                      "background": "#f7fafc",
                      "on-tertiary": "#ffffff",
                      "on-error-container": "#93000a",
                      "surface-dim": "#d7dadc",
                      "surface-bright": "#f7fafc",
                      "on-secondary-fixed": "#00201f",
                      "surface-container-high": "#e5e9eb",
                      "primary-fixed": "#cde5ff",
                      "on-primary": "#ffffff",
                      "error": "#ba1a1a",
                      "secondary": "#006a68",
                      "primary": "#00182a",
                      "on-background": "#181c1e",
                      "on-tertiary-fixed-variant": "#00504a",
                      "surface-variant": "#e0e3e5",
                      "secondary-fixed-dim": "#77d6d3",
                      "on-primary-fixed": "#001d31",
                      "on-secondary-container": "#006e6d",
                      "surface-tint": "#476178",
                      "on-primary-fixed-variant": "#2f495f",
                      "tertiary-fixed-dim": "#5adace",
                      "surface-container-highest": "#e0e3e5",
                      "error-container": "#ffdad6",
                      "secondary-fixed": "#94f2f0",
                      "on-error": "#ffffff",
                      "surface-container-lowest": "#ffffff",
                      "tertiary-container": "#00312d"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "md": "24px",
                      "lg": "40px",
                      "xl": "64px",
                      "sm": "16px",
                      "gutter": "24px",
                      "margin-desktop": "48px",
                      "margin-mobile": "16px",
                      "base": "4px",
                      "xs": "8px"
              },
              "fontFamily": {
                      "body-lg": ["Inter"],
                      "label-sm": ["Inter"],
                      "headline-lg": ["Manrope"],
                      "body-sm": ["Inter"],
                      "body-md": ["Inter"],
                      "headline-xl": ["Manrope"],
                      "headline-lg-mobile": ["Manrope"],
                      "headline-md": ["Manrope"],
                      "label-md": ["Inter"]
              },
              "fontSize": {
                      "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                      "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                      "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                      "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                      "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                      "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
              }
            },
          },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .vibrant-gradient {
            background: linear-gradient(135deg, #00182a 0%, #112d42 40%, #006a68 100%);
        }
        .form-input-focus:focus {
            outline: none;
            box-shadow: 0 0 0 2px #319795;
            border-color: #319795;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #E2E8F0;
        }
        .password-masked-input {
            color: transparent !important;
            -webkit-text-fill-color: transparent !important;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md selection:bg-secondary-container selection:text-on-secondary-container">
    <main class="min-h-[calc(100vh-160px)] flex items-center justify-center py-xl px-margin-mobile md:px-margin-desktop">
        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-12 rounded-[2rem] overflow-hidden shadow-2xl glass-card">
            <!-- Side Illustration Panel -->
            <div class="hidden md:flex md:col-span-5 vibrant-gradient p-xl flex-col justify-between text-on-secondary relative overflow-hidden">
                <!-- Abstract Atmospheric Shapes -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary-container/40 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h1 class="font-headline-xl text-headline-xl mb-md leading-tight">Mulai Karir Impianmu Sekarang.</h1>
                    <p class="font-body-lg text-body-lg opacity-80 mb-xl">Bergabunglah dengan ribuan profesional dan temukan kesempatan kerja terbaik yang sesuai dengan keahlianmu.</p>
                    <div class="space-y-md">
                        <div class="flex items-center gap-sm bg-white/10 p-sm rounded-xl backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary-container">verified_user</span>
                            <span class="font-label-md">Perusahaan Terverifikasi</span>
                        </div>
                        <div class="flex items-center gap-sm bg-white/10 p-sm rounded-xl backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary-container">trending_up</span>
                            <span class="font-label-md">Update Lowongan Real-time</span>
                        </div>
                        <div class="flex items-center gap-sm bg-white/10 p-sm rounded-xl backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary-container">psychology</span>
                            <span class="font-label-md">Rekomendasi Berbasis AI</span>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 mt-xl">
                    <img alt="Career Success" class="rounded-xl shadow-lg border-2 border-white/20 object-cover aspect-video" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGzQXNWgFdDkrkv_7sz4qnJy9nVo4Kvp2ab9jI19UyWSZC97MpUYq5Ezm0iiCZ8bmgJ4ZlZg2mlqZSvdt-EeodHAC5LSBzZXEVI9fpyG00FL_dlQq-ALItsMwLCPumOOaB3lqD7KZ4Yrpdapf-v-zFkkYaPIfG_Bse4uxngYZyKIA_7Zy69APVElH7xR7Xx1CCUFf3yNN2ATu7pCny42lSLPeZ1Tk7GT526Rz3fHD1FCifSayqrahnp9Qd4xWmzG9kLvcIDhGlNEs">
                </div>
            </div>
            <!-- Registration Form Panel -->
            <div class="md:col-span-7 p-md md:p-xl bg-white">
                <div class="max-w-md mx-auto">
                    <div class="mb-lg flex flex-col gap-1">
                        <a href="/pilihRole" class="flex items-center gap-2 text-secondary hover:text-primary transition-colors font-semibold text-sm w-fit mb-2">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                            Kembali ke Pilih Peran
                        </a>
                        <h2 class="font-headline-lg text-headline-lg text-primary mb-xs">Buat Akun Baru</h2>
                        <p class="text-on-surface-variant font-body-md">Lengkapi data diri untuk memulai perjalanan karirmu.</p>
                    </div>

                    <!-- Alerts for Laravel Errors & Success Sessions -->
                    @if ($errors->any())
                        <div class="mb-md p-sm bg-error-container text-on-error-container rounded-lg border border-error/20 font-body-sm">
                            <div class="font-bold mb-xs flex items-center gap-xs text-error">
                                <span class="material-symbols-outlined text-error">error</span>
                                Registrasi Gagal
                            </div>
                            <ul class="list-disc pl-sm space-y-1">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-md p-sm bg-secondary-container text-on-secondary-container rounded-lg border border-secondary/20 font-body-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-secondary">check_circle</span>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('register.pelamar') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                        @csrf
                        <!-- Full Name -->
                        <div class="flex flex-col gap-xs md:col-span-2">
                            <label for="fullname" class="font-label-md text-primary">Nama Lengkap</label>
                            <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-body-md form-input-focus" placeholder="John Doe" type="text" name="nama_lengkap" id="fullname" value="{{ old('nama_lengkap') }}">
                        </div>
                        <!-- Username -->
                        <div class="flex flex-col gap-xs">
                            <label for="usn" class="font-label-md text-primary">Username</label>
                            <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-body-md form-input-focus" placeholder="johndoe123" type="text" name="username" id="usn" value="{{ old('username') }}">
                        </div>
                        <!-- Phone Number -->
                        <div class="flex flex-col gap-xs">
                            <label for="no_telp" class="font-label-md text-primary">Nomor Telepon</label>
                            <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-body-md form-input-focus" placeholder="0812xxxx" type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}">
                        </div>
                        <!-- Email -->
                        <div class="flex flex-col gap-xs md:col-span-2">
                            <label for="email" class="font-label-md text-primary">Email</label>
                            <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-body-md form-input-focus" placeholder="name@gmail.com" type="email" name="email" id="email" value="{{ old('email') }}">
                        </div>
                        <!-- Password -->
                        <div class="flex flex-col gap-xs">
                            <label for="pass" class="font-label-md text-primary">Password</label>
                            <div class="relative w-full">
                                <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-mono text-base form-input-focus caret-primary" placeholder="••••••••" type="password" name="password" id="pass">
                                <div id="pass-dots-container" class="absolute inset-y-0 left-0 flex items-center px-sm pointer-events-none select-none font-mono text-base leading-none z-10"></div>
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <div class="flex flex-col gap-xs">
                            <label for="conf" class="font-label-md text-primary">Konfirmasi Password</label>
                            <div class="relative w-full">
                                <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-mono text-base form-input-focus caret-primary" placeholder="••••••••" type="password" name="conf" id="conf">
                                <div id="conf-dots-container" class="absolute inset-y-0 left-0 flex items-center px-sm pointer-events-none select-none font-mono text-base leading-none z-10"></div>
                            </div>
                        </div>
                        <!-- Skills -->
                        <div class="flex flex-col gap-xs md:col-span-2">
                            <label for="skills" class="font-label-md text-primary">Keahlian (Pisahkan dengan koma)</label>
                            <input class="w-full px-sm py-xs rounded-lg border border-outline-variant bg-surface-container-lowest font-body-md form-input-focus" placeholder="UI Design, Project Management, Data Analysis" type="text" name="keahlian" id="skills" value="{{ old('keahlian') }}">
                        </div>
                        <!-- Agreement -->
                        <div class="md:col-span-2 flex items-start gap-xs py-xs">
                            <input class="mt-1 rounded border-outline-variant text-secondary focus:ring-secondary" id="terms" type="checkbox">
                            <label class="text-body-sm text-on-surface-variant" for="terms">Saya menyetujui <a class="text-secondary font-bold hover:underline" href="#">Syarat &amp; Ketentuan</a> serta <a class="text-secondary font-bold hover:underline" href="#">Kebijakan Privasi</a> KerjaYuk.</label>
                        </div>
                        <!-- Action Button -->
                        <div class="md:col-span-2 mt-md">
                            <button class="w-full py-sm bg-secondary text-on-secondary font-headline-md rounded-xl hover:opacity-90 hover:scale-[1.02] transition-all active:scale-95 shadow-md" type="submit" id="next">
                                Lanjut
                            </button>
                        </div>
                    </form>
                    <div class="mt-lg text-center">
                        <p class="text-body-md text-on-surface-variant">
                            Sudah punya akun? 
                            <a class="text-secondary font-bold hover:underline transition-all" href="/login/pelamar">Masuk</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="w-full py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-md bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant">
        <div class="flex flex-col items-center md:items-start gap-xs">
            <span class="font-headline-md text-headline-md font-black text-primary dark:text-inverse-primary">KerjaYuk</span>
            <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 KerjaYuk. Empowering your career velocity.</p>
        </div>
        <div class="flex gap-lg flex-wrap justify-center">
            <a class="text-on-surface-variant hover:text-primary font-label-md transition-all hover:underline decoration-secondary" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant hover:text-primary font-label-md transition-all hover:underline decoration-secondary" href="#">Terms of Service</a>
            <a class="text-on-surface-variant hover:text-primary font-label-md transition-all hover:underline decoration-secondary" href="#">Help Center</a>
            <a class="text-on-surface-variant hover:text-primary font-label-md transition-all hover:underline decoration-secondary" href="#">Contact Us</a>
            <a class="text-on-surface-variant hover:text-primary font-label-md transition-all hover:underline decoration-secondary" href="#">Careers</a>
        </div>
    </footer>
    <script>
        // Micro-interaction for form inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('label')?.classList.add('text-secondary');
            });
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('label')?.classList.remove('text-secondary');
            });
        });

        // Password matching dot indicator logic
        const passInput = document.getElementById('pass');
        const confInput = document.getElementById('conf');
        const passDots = document.getElementById('pass-dots-container');
        const confDots = document.getElementById('conf-dots-container');

        function updatePasswordDots() {
            const passVal = passInput.value;
            const confVal = confInput.value;

            // 1. Update Password Dots
            if (passVal === '') {
                passInput.classList.remove('password-masked-input');
                passDots.innerHTML = '';
            } else {
                passInput.classList.add('password-masked-input');
                let html = '';
                for (let i = 0; i < passVal.length; i++) {
                    html += '<div class="flex justify-center items-center" style="width: 1ch;"><span class="w-2 h-2 rounded-full bg-[#181c1e]"></span></div>';
                }
                passDots.innerHTML = html;
            }

            // 2. Update Confirm Password Dots
            if (confVal === '') {
                confInput.classList.remove('password-masked-input');
                confDots.innerHTML = '';
            } else {
                confInput.classList.add('password-masked-input');
                let html = '';

                for (let i = 0; i < confVal.length; i++) {
                    if (i < passVal.length && confVal[i] === passVal[i]) {
                        // Match -> Green Dot
                        html += '<div class="flex justify-center items-center" style="width: 1ch;"><span class="w-2 h-2 rounded-full bg-green-500"></span></div>';
                    } else {
                        // No Match -> Red Dot
                        html += '<div class="flex justify-center items-center" style="width: 1ch;"><span class="w-2 h-2 rounded-full bg-red-500"></span></div>';
                    }
                }
                confDots.innerHTML = html;
            }
        }

        passInput.addEventListener('input', updatePasswordDots);
        confInput.addEventListener('input', updatePasswordDots);
    </script>
</body>
</html>
