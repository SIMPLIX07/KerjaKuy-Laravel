<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.PELAMAR_ID = {{ session('pelamar_id') }};
        window.LOWONGAN_ID = {{ $lowongan->id }};
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamar - {{ $lowongan->posisi_pekerjaan }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/pageLamar/lamar.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="detail-wrapper">
            <div class="banner-container">
                @if($lowongan->gambar)
                    <img src="{{ asset('storage/lowongan/' . $lowongan->gambar) }}" class="banner-img">
                @else
                    <img src="/assets/default-banner.jpg" class="banner-img">
                @endif

                <div class="profile-overlay">
                    <img src="{{ $lowongan->perusahaan->foto_profil ? asset('storage/' . $lowongan->perusahaan->foto_profil) : '/assets/default-logo.png' }}"
                        class="company-logo">
                    <div class="company-info-header">
                        <h4>{{ $lowongan->perusahaan->nama_perusahaan }}</h4>
                        <p>{{ $lowongan->posisi_pekerjaan }}</p>
                    </div>
                </div>
            </div>

            <div class="meta-bar">
                <div class="meta-items">
                    <div><i class="fas fa-money-bill-wave"></i> IDR {{ number_format((int) $lowongan->gaji, 0, ',', '.') }}</div>
                    <div><i class="far fa-clock"></i> {{ $lowongan->jenis_pekerjaan }}</div>
                    <div><i class="fas fa-map-marker-alt"></i> {{ $lowongan->kabupaten }}, {{ $lowongan->provinsi }}</div>
                </div>
                <div class="action-btns">
                    <button type="button" class="button">Lamar Sekarang</button>
                </div>
            </div>

            <div class="content-section">
                <h5>Deskripsi Singkat</h5>
                <p>• {{ $lowongan->deskripsi_singkat }}</p>
            </div>

            <div class="content-section">
                <h5>Deskripsi Pekerjaan</h5>
                <div class="text-muted-custom">
                    {!! nl2br(e($lowongan->deskripsi_pekerjaan)) !!}
                </div>
            </div>

            <div class="content-section mb-4">
                <h5>Syarat</h5>
                <div class="text-muted-custom">
                    {!! nl2br(e($lowongan->syarat)) !!}
                </div>
            </div>
        </div>
    </div>

    <div id="modalCv" class="modal">
        <div class="modal-content large">
            <h3>Pilih CV</h3>
            <div id="cvList" class="cv-list"></div>
            <div class="modal-action">
                <button id="btnKirimLamaran" disabled>Kirim Lamaran</button>
                <button id="btnTutup">Batal</button>
            </div>
        </div>
    </div>

    <div id="successModal" class="popup-overlay">
        <div class="popup-box">
            <h3>Lamaran Berhasil 🎉</h3>
            <p>Lamaran kamu berhasil dikirim. Silakan menunggu proses selanjutnya.</p>
            <button id="btnOk">Lihat Lamaran</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/pageLamar/lamar.js"></script>
</body>
</html>