<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy - Wawancara</title>

    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">

</head>

<body>
    <div class="header">

        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="/assets/LamaranAnda/asset/KerjaKuy.png" alt="Kerjakuy Logo" class="logo-img">
                    <span class="brand-text">KerjaKuy</span>
                </div>

                <div class="nav-menu">
                    <a href="/home-perusahaan" class="nav-link">Lowongan Anda</a>
                    <a href="/karyawanPerusahaan" class="nav-link">Karyawan</a>
                    <a href="/perusahaan/wawancara" class="nav-link active">Wawancara</a>
                </div>

                <div class="nav-user">
                    <span class="user-margin">
                        <a class="nav-user" href="{{ route('perusahaan.settings') }}">
                            {{ session('perusahaan_nama') }}
                        </a>
                    </span>
                </div>
            </div>
        </nav>

        <div class="search-bar-container">
            <div class="search-form-wrapper">
                <input type="text"
                    placeholder="Cari jadwal wawancara"
                    class="search-input">
                <button class="search-button">Cari</button>
            </div>
        </div>

    </div>

    <div class="main-grid">
        <div class="tabs-wrapper">
            <div class="tabs-container">
                <button class="tab-btn tab-active" data-tab="akan-datang">
                    Akan Datang
                </button>
                <button class="tab-btn" data-tab="diproses">
                    Diproses
                </button>
            </div>
        </div>
        <div class="cards-container" style="grid-column: span 12;">

            @forelse ($wawancarans as $wawancara)
            <div class="card" data-status="{{ $wawancara->status }}">

                <div class="card-title">
                    {{ $wawancara->lowongan->posisi_pekerjaan }}
                </div>

                <div class="card-company">
                    {{ $wawancara->pelamar->nama }}
                </div>

                <div class="card-desc">
                    @if ($wawancara->status === 'akan-datang')
                    Jadwal wawancara telah ditentukan
                    @elseif ($wawancara->status === 'diproses')
                    Menunggu konfirmasi pelamar
                    @endif
                </div>

                <div class="card-date">
                    {{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d M Y') }}
                    • {{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}
                </div>

            </div>
            @empty
            <div class="empty-wrapper">
                <div class="empty-card">
                    <h3>Belum ada wawancara</h3>
                    <p>
                        Belum ada jadwal wawancara untuk lowongan kamu.
                    </p>
                </div>
            </div>
            @endforelse

        </div>

    </div>

    <script src="/assets/LamaranAnda/Lamaran.js"></script>
</body>

</html>