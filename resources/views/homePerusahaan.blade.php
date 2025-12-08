<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Perusahaan</title>

    <link rel="stylesheet" href="/assets/HomePerusahaan/homePerusahaan.css">
</head>
<body>

    <nav class="cstm-navbar">
        <div class="cstm-nav-container">
            <div class="nav-logo">
                <img src="/assets/HomePelamar/asset/KerjaKuy.png" class="logo-img">
                <span class="brand-text">KerjaKuy</span>
            </div>

            <div class="cstm-nav-menu">
                <a href="#" class="cstm-nav-link active">Lowongan</a>
                <a href="/karyawanPerusahaan" class="cstm-nav-link">Karyawan</a>
            </div>

            <div class="cstm-nav-user">
                <span class="cstm-user-margin">{{ session('perusahaan_nama') }}</span>
                <a href="/logout" class="logout-btn">Logout</a>
            </div>
        </div>
    </nav>

    <div class="search-container">
        <input type="text" placeholder="Cari lowongan" class="search-input">
        <button class="search-btn">Cari</button>
    </div>

    <div class="plus-wrapper">
        <a href="/buat-lowongan" class="btn-plus">+</a>
    </div>

    <div class="card-wrapper">
        {{-- contoh statis dulu nanti backend --}}
        <div class="job-card">
            <h3>Back-end Developer</h3>
            <p>Dicari developer yang mahir dalam logika server...</p>
            <p class="pelamar-info">Pelamar: <span class="badge">12</span></p>
            <p class="date-info">20-10-2025 — 10-11-2025</p>
        </div>
    </div>

</body>
</html>
