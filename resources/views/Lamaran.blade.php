<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy</title>
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="/assets/LamaranAnda/asset/KerjaKuy.png" alt="Kerjakuy Logo" class="logo-img">
                <span class="brand-text">KerjaKuy</span>
            </div>

            <div class="nav-menu">
                {{-- ganti agar bisa pindah halaman --}}
                <a href="/home-pelamar" class="nav-link">Lowongan Kerja</a>
                <a href="/lamaran-anda" class="nav-link active">Lamaran Anda</a>
            </div>

            <div class="nav-user">
                <span class="user-margin"><a class="nav-user" href="/setting">{{ session('pelamar_nama') }}</a></span>
            </div>
        </div>
    </nav>

    <div class="search-bar-container" style="grid-column: span 12;">
        <div class="search-form-wrapper"> <input type="text" placeholder="Cari pekerjaan yang dilamar"
                class="search-input">
            <button class="search-button">Cari</button>
        </div>
    </div>


    <div class="main-grid">

        <div class="tabs-wrapper">
            <div class="tabs-container">
                <button class="tab-btn" data-tab="diterima">Diterima</button>
                <button class="tab-btn tab-active" data-tab="diproses">Diproses</button>
                <button class="tab-btn" data-tab="ditolak">Ditolak</button>
            </div>
        </div>

        <div class="cards-container" style="grid-column: span 12;">
            <div class="card" data-status="diterima">
                <div class="card-title">UI/UX Designer</div>
                <div class="card-company">PT. Nebula</div>
                <div class="card-desc">Sabar ya, lamaran kamu sedang dalam proses pemeriksaan</div>
                <div class="card-date">10-09-2025</div>
            </div>


            <div class="card" data-status="diproses">
                <div class="card-title">UI/UX Designer</div>
                <div class="card-company">PT. Nebula</div>
                <div class="card-desc">Sabar ya, lamaran kamu sedang dalam proses pemeriksaan</div>
                <div class="card-date">10-09-2025</div>

            </div>

            <div class="card" data-status="ditolak">
                <div class="card-title">UI/UX Designer</div>
                <div class="card-company">PT. Nebula</div>
                <div class="card-desc">Sabar ya, lamaran kamu sedang dalam proses pemeriksaan</div>
                <div class="card-date">10-09-2025</div>
            </div>
        </div>

    </div>

    <script src="/assets/LamaranAnda/Lamaran.js"></script>
</body>

</html>