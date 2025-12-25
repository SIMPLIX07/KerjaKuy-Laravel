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
            @forelse ($lamarans as $lamaran)
            <div class="card" data-status="{{ $lamaran->status }}">
                <div class="card-title">
                    {{ $lamaran->lowongan->posisi_pekerjaan }}
                </div>

                <div class="card-company">
                    {{ $lamaran->lowongan->perusahaan->nama_perusahaan }}
                </div>

                <div class="card-desc">
                    @if ($lamaran->status === 'proses')
                    Lamaran kamu sedang diproses
                    @elseif ($lamaran->status === 'wawancara')
                    Kamu dipanggil untuk tahap wawancara
                    @elseif ($lamaran->status === 'diterima')
                    Selamat! Kamu diterima 🎉
                    @else
                    Maaf, kamu belum lolos
                    @endif
                </div>

                <div class="card-date">
                    {{ $lamaran->created_at->format('d-m-Y') }}
                </div>
            </div>
            @empty
            <div class="empty-wrapper">
                <div class="empty-card">
                    <h3>Belum ada lamaran</h3>
                    <p>
                        Kamu belum mengirim lamaran ke lowongan mana pun.<br>
                        Silakan cari lowongan dan mulai melamar.
                    </p>

                    <a href="/home-pelamar" class="empty-btn">
                        Cari Lowongan
                    </a>
                </div>
            </div>
            @endforelse


        </div>


    </div>

    <script src="/assets/LamaranAnda/Lamaran.js"></script>
</body>

</html>