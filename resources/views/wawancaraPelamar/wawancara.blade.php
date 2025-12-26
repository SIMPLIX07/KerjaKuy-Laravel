<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Wawancara</title>
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
    <link rel="stylesheet" href="/assets/wawancaraPelamar/wawancara.css">
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
                    <a href="/home-pelamar" class="nav-link">Lowongan Kerja</a>
                    <a href="/lamaran-anda" class="nav-link">Lamaran Anda</a>
                    <a href="/wawancara" class="nav-link active">Wawancara</a>
                </div>

                <div class="nav-user">
                    <span class="user-margin">
                        <a class="nav-user" href="/setting">{{ session('pelamar_nama') }}</a>
                    </span>
                </div>
            </div>
        </nav>

        <div class="search-bar-container">
            <div class="search-form-wrapper">
                <input type="text" placeholder="Cari jadwal wawancara" class="search-input">
                <button class="search-button">Cari</button>
            </div>
        </div>
    </div>

    <div class="main-grid">
        <div class="tabs-wrapper">
            <div class="tabs-container">
                <button class="tab-btn tab-active" data-tab="proses">
                    Akan Datang
                </button>
                <button class="tab-btn" data-tab="selesai">
                    Selesai
                </button>
            </div>
        </div>

        <div class="cards-container">
            @forelse ($wawancarans as $wawancara)
                <div class="card-wawancara card" data-status="{{ $wawancara->status }}">

                    <div class="posisi-pekerjaan">
                        {{ $wawancara->lowongan->posisi_pekerjaan }}
                    </div>

                    <div class="nama-perusahaan">
                        {{ $wawancara->lowongan->perusahaan->nama_perusahaan }}
                    </div>

                    <div class="pesan-teks">
                        {{ $wawancara->pesan ?? 'Kami tertarik dengan CV kamu, ditunggu di wawancara nanti ya' }}
                    </div>

                    <div class="link-label">Link:</div>
                    <a href="{{ $wawancara->link_meet }}" target="_blank" class="link-url">
                        {{ $wawancara->link_meet }}
                    </a>

                    <div class="jadwal-info">
                        <div class="jadwal-item">
                            <img src="{{ asset('assets/wawancaraPelamar/asset/kalender.png') }}" class="icon-img"
                                alt="Ikon Kalender">
                            <span>{{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d-m-Y') }}</span>
                        </div>
                        <div class="jadwal-item">
                            <img src="{{ asset('assets/wawancaraPelamar/asset/jam.png') }}" class="icon-img" alt="Ikon Jam">
                            <span>{{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}</span>
                        </div>
                    </div>

                </div>
            @empty
                <div class="empty-wrapper">
                    <div class="empty-card">
                        <h3>Belum ada wawancara</h3>
                        <p>
                            Kamu belum memiliki jadwal wawancara.<br>
                            Pantau terus lamaran kamu ya.
                        </p>

                        <a href="/lamaran-anda" class="empty-btn">
                            Lihat Lamaran
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="/assets/wawancaraPelamar/wawancaraPelamar.js"></script>
</body>

</html>