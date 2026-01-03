<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Wawancara</title>
    <link rel="stylesheet" href="/assets/HomePelamar/style.css" />
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
    <link rel="stylesheet" href="/assets/wawancaraPelamar/wawancara.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="cstm-navbar">
        <div class="cstm-nav-container">
            <div class="nav-logo">
                <img src="/assets/HomePelamar/asset/KerjaKuy.png" alt="Logo" class="logo-img" />
                <a href="/" class="brand-text" style="text-decoration:none;">KerjaKuy</a>
            </div>

            <div class="cstm-nav-menu">
                <a href="/home-pelamar" class="cstm-nav-link">Lowongan Kerja</a>
                <a href="/lamaran-anda" class="cstm-nav-link">Lamaran Anda</a>
                <a href="/wawancara" class="cstm-nav-link active">Wawancara</a>
            </div>

            <div class="cstm-nav-user">
                <a href="{{ route('pelamar.settings') }}" style="color:white; text-decoration:none;">
                    {{ session('pelamar_nama') }}
                </a>
            </div>
        </div>
    </nav>

    <div class="search-bar-container">
        <div class="search-form-wrapper">
            <input type="text" placeholder="Cari Nama Perusahaan" class="search-input">
            <button class="search-button">Cari</button>
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

                    <div class="link-label">Link:
                        <a href="{{ $wawancara->link_meet }}" target="_blank" class="link-url">
                            {{ $wawancara->link_meet }}
                        </a>
                    </div>

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