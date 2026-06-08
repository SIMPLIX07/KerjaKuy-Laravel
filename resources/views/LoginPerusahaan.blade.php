<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk Perusahaan - KerjaKuy</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-surface": "#181c1e",
                    "primary-fixed-dim": "#afc9e4",
                    "on-secondary": "#ffffff",
                    "surface-tint": "#476178",
                    "surface-container-lowest": "#ffffff",
                    "surface": "#f7fafc",
                    "tertiary-fixed": "#79f7ea",
                    "surface-bright": "#f7fafc",
                    "on-error": "#ffffff",
                    "inverse-surface": "#2d3133",
                    "outline": "#73777d",
                    "on-secondary-container": "#006e6d",
                    "tertiary-container": "#00312d",
                    "on-secondary-fixed": "#00201f",
                    "on-tertiary": "#ffffff",
                    "primary": "#00182a",
                    "inverse-primary": "#afc9e4",
                    "surface-container": "#ebeef0",
                    "primary-container": "#112d42",
                    "outline-variant": "#c3c7cd",
                    "on-tertiary-fixed": "#00201d",
                    "background": "#f7fafc",
                    "on-primary-fixed": "#001d31",
                    "tertiary-fixed-dim": "#5adace",
                    "secondary": "#006a68",
                    "surface-variant": "#e0e3e5",
                    "on-primary": "#ffffff",
                    "on-primary-fixed-variant": "#2f495f",
                    "inverse-on-surface": "#eef1f3",
                    "on-error-container": "#93000a",
                    "on-surface-variant": "#43474c",
                    "secondary-container": "#91f0ed",
                    "on-primary-container": "#7b95ae",
                    "tertiary": "#001a18",
                    "on-secondary-fixed-variant": "#00504e",
                    "secondary-fixed": "#94f2f0",
                    "on-tertiary-fixed-variant": "#00504a",
                    "surface-dim": "#d7dadc",
                    "primary-fixed": "#cde5ff",
                    "on-tertiary-container": "#00a499",
                    "surface-container-high": "#e5e9eb",
                    "surface-container-highest": "#e0e3e5",
                    "error-container": "#ffdad6",
                    "error": "#ba1a1a",
                    "secondary-fixed-dim": "#77d6d3",
                    "on-background": "#181c1e",
                    "surface-container-low": "#f1f4f6"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "xl": "64px",
                    "margin-desktop": "48px",
                    "xs": "8px",
                    "md": "24px",
                    "sm": "16px",
                    "lg": "40px",
                    "gutter": "24px",
                    "margin-mobile": "16px",
                    "base": "4px"
            },
            "fontFamily": {
                    "label-sm": ["Inter"],
                    "headline-xl": ["Manrope"],
                    "body-md": ["Inter"],
                    "label-md": ["Inter"],
                    "headline-lg-mobile": ["Manrope"],
                    "headline-md": ["Manrope"],
                    "headline-lg": ["Manrope"],
                    "body-sm": ["Inter"],
                    "body-lg": ["Inter"]
            },
            "fontSize": {
                    "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                    "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7fafc; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hero-gradient { background: linear-gradient(135deg, #00182a 0%, #006a68 100%); }
    </style>
</head>
<body class="bg-background text-on-surface">
<main class="min-h-screen flex flex-col md:flex-row">
    <!-- Left Side: Inspiring Hero Section -->
    <div class="hidden md:flex md:w-1/2 hero-gradient relative items-center justify-center p-xl overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[400px] h-[400px] bg-secondary opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[300px] h-[300px] bg-primary-container opacity-20 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-lg text-left">
            <div class="mb-lg">
                <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">KerjaKuy</h1>
                <div class="h-1 w-24 bg-secondary-fixed rounded-full"></div>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-primary mb-sm">Kelola Talenta Terbaik Anda</h2>
            <p class="font-body-lg text-body-lg text-primary-fixed-dim">Masuk ke Dashboard Perusahaan untuk mulai merekrut dan bangun tim impian Anda hari ini.</p>
            <div class="mt-xl grid grid-cols-2 gap-md">
                <div class="bg-primary-container/30 backdrop-blur-md p-md rounded-xl border border-on-primary/10">
                    <span class="material-symbols-outlined text-secondary-fixed mb-xs">verified_user</span>
                    <p class="font-label-md text-label-md text-on-primary">Talenta Terverifikasi</p>
                </div>
                <div class="bg-primary-container/30 backdrop-blur-md p-md rounded-xl border border-on-primary/10">
                    <span class="material-symbols-outlined text-secondary-fixed mb-xs">bolt</span>
                    <p class="font-label-md text-label-md text-on-primary">Rekrutmen Cepat</p>
                </div>
            </div>
        </div>
        <!-- Contextual Image Support -->
        <div class="absolute bottom-0 right-0 w-full h-1/3 opacity-20 pointer-events-none">
            <img class="w-full h-full object-cover grayscale" data-alt="A modern corporate office environment" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvs0t9g8EQDRaypI_Bh0KtZ-pTlHhfUnCn8vP-5L37EQcF8qrZKPlURvhlYI5AdiNMuz942kHVwyM4Vc2k9bF4SdECIhxR2Oo81QXPO4WBM-pdAqsmIf-pHasPqLdaAap9BMRijAEvpcXGtWzqZpuIL7iRqgrO-T4itpbrAZ4MZsJlCBOiGrbgzeR1Lf3HTMuDMuMWyBOo2v50qRdVh-thleL5_uKrAhI1a5Pll__7HicziAxQCc4oYF20SYt9CddjWlT7HuYtIjw"/>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="flex-1 flex items-center justify-center p-margin-mobile md:p-xl bg-surface">
        <div class="w-full max-w-[480px] bg-surface-container-lowest p-md md:p-lg rounded-xl border border-outline-variant shadow-sm">
            <!-- Brand Mobile Header -->
            <div class="md:hidden flex justify-center mb-lg">
                <h2 class="font-headline-md text-headline-md font-bold text-primary">KerjaKuy</h2>
            </div>
            <div class="mb-xl">
                <h3 class="font-headline-md text-headline-md text-primary mb-xs">Masuk ke Akun Perusahaan</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Silakan masukkan kredensial perusahaan Anda untuk melanjutkan.</p>
            </div>

            <!-- Errors and Success Alerts -->
            @if ($errors->any())
                <div class="mb-md p-md bg-error/10 border border-error/30 text-error rounded-xl flex flex-col gap-xs">
                    <div class="flex items-center gap-sm">
                        <span class="material-symbols-outlined text-error">error</span>
                        <span class="font-label-md font-bold">Gagal Masuk:</span>
                    </div>
                    <ul class="list-disc list-inside text-body-sm pl-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-md p-md bg-secondary/10 border border-secondary/30 text-secondary rounded-xl flex items-center gap-sm">
                    <span class="material-symbols-outlined text-secondary">check_circle</span>
                    <span class="font-body-sm">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login.perusahaan') }}" method="POST" class="space-y-md" id="loginForm">
                @csrf
                <!-- Email Field -->
                <div class="space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="email">Email Perusahaan</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">corporate_fare</span>
                        <input name="email" class="w-full pl-[48px] pr-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" id="email" placeholder="nama@perusahaan.com" type="email" value="{{ old('email') }}" required/>
                    </div>
                </div>
                <!-- Password Field -->
                <div class="space-y-xs">
                    <div class="flex justify-between items-center">
                        <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                        <a class="font-label-sm text-label-sm text-secondary hover:underline transition-all" href="#">Lupa kata sandi?</a>
                    </div>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">lock</span>
                        <input name="password" class="w-full pl-[48px] pr-[48px] py-sm bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all" id="password" placeholder="••••••••" type="password" required/>
                        <button class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" onclick="togglePassword()" type="button">
                            <span class="material-symbols-outlined" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                </div>
                <!-- Remember Me -->
                <div class="flex items-center space-x-xs pt-xs">
                    <input name="remember" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary" id="remember" type="checkbox"/>
                    <label class="font-body-sm text-body-sm text-on-surface-variant select-none" for="remember">Ingat Saya</label>
                </div>
                <!-- Primary Action -->
                <button class="w-full bg-secondary hover:bg-on-secondary-container text-on-secondary font-label-md text-label-md py-md rounded-lg shadow-md transition-all active:scale-[0.98] mt-sm font-bold" type="submit">
                    Masuk
                </button>
            </form>

            <!-- Footer Links -->
            <div class="mt-xl pt-lg border-t border-outline-variant text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Belum punya akun? 
                    <a class="text-secondary font-semibold hover:underline ml-xs transition-all" href="/register/perusahaan">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="w-full py-lg px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-gutter bg-surface-container-highest border-t border-outline-variant">
    <div class="flex flex-col gap-xs mb-md md:mb-0">
        <span class="font-headline-sm text-headline-sm font-extrabold text-primary">KerjaKuy</span>
        <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 KerjaKuy. All rights reserved.</p>
    </div>
    <div class="flex flex-wrap justify-center gap-gutter">
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Tentang Kami</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Pusat Bantuan</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Kebijakan Privasi</a>
        <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Syarat &amp; Ketentuan</a>
    </div>
</footer>

<!-- Verification Pending Modal -->
@if(session('info'))
<div id="verification-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-md mx-margin-mobile md:mx-0 relative flex flex-col border border-outline-variant/30 text-center items-center">
        <div class="w-16 h-16 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center mb-md">
            <span class="material-symbols-outlined text-[32px]">schedule</span>
        </div>
        <h3 class="text-headline-md font-headline-md text-on-surface mb-xs" id="verification-title">Menunggu Verifikasi</h3>
        <p class="text-on-surface-variant font-body-sm mb-lg">
            {{ session('info') }}
        </p>
        <button type="button" id="verification-close" class="px-lg h-12 bg-secondary text-on-secondary rounded-lg font-label-md shadow-md hover:opacity-90 transition-all active:scale-95 w-full font-bold">
            Kembali ke Halaman Utama
        </button>
    </div>
</div>
<script>
    document.getElementById('verification-close').addEventListener('click', function() {
        window.location.href = "{{ url('/') }}";
    });
</script>
@endif

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerText = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerText = 'visibility';
        }
    }
</script>
</body>
</html>
