<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy - Wawancara</title>
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
</head>

<body>
    <div class="header">

        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="/assets/LamaranAnda/asset/KerjaKuy.png" class="logo-img">
                    <span class="brand-text">KerjaKuy</span>
                </div>

                <div class="nav-menu">
                    <a href="/home-pelamar" class="nav-link">Lowongan Kerja</a>
                    <a href="/lamaran-anda" class="nav-link">Lamaran Anda</a>
                    <a href="/wawancara" class="nav-link active">Wawancara</a>
                </div>

                <div class="nav-user">
                    <a class="nav-user" href="/setting">{{ session('pelamar_nama') }}</a>
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

        <!-- TABS -->
        <div class="tabs-wrapper">
            <div class="tabs-container">
                <button class="tab-btn tab-active" data-tab="akan-datang">
                    Akan Datang
                </button>
                <button class="tab-btn" data-tab="selesai">
                    Selesai
                </button>
            </div>
        </div>

        <!-- CARDS -->
        <div class="cards-container" style="grid-column: span 12;">

            @forelse ($wawancarans as $wawancara)
            <div class="card"
                data-status="{{ $wawancara->status === 'proses' ? 'akan-datang' : 'selesai' }}">

                <div class="card-title">
                    {{ $wawancara->lowongan->posisi_pekerjaan }}
                </div>

                <div class="card-company">
                    {{ $wawancara->lowongan->perusahaan->nama_perusahaan }}
                </div>

                <div class="card-desc">
                    @if ($wawancara->status === 'proses')
                    Jadwal wawancara telah ditentukan
                    @elseif ($wawancara->status === 'selesai')
                    Wawancara telah selesai
                    @endif
                </div>

                <div class="card-date">
                    {{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d M Y') }}
                    • {{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}
                </div>
                <button
                    class="detail-btn"
                    data-posisi="{{ $wawancara->lowongan->posisi_pekerjaan }}"
                    data-perusahaan="{{ $wawancara->lowongan->perusahaan->nama_perusahaan }}"
                    data-tanggal="{{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d M Y') }}"
                    data-jam="{{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}"
                    data-status="{{ $wawancara->status }}"
                    data-link="{{ $wawancara->link_meet }}"
                    data-pesan="{{ $wawancara->pesan }}">
                    Detail
                </button>

            </div>
            @empty
            <div class="empty-wrapper">
                <div class="empty-card">
                    <h3>Belum ada wawancara</h3>
                    <p>Kamu belum memiliki jadwal wawancara.</p>
                    <a href="/lamaran-anda" class="empty-btn">Lihat Lamaran</a>
                </div>
            </div>
            @endforelse

        </div>
    </div>

    <script src="/assets/wawancaraPelamar/wawancaraPelamar.js"></script>
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <h3 id="modalPosisi"></h3>
            <p><strong>Perusahaan:</strong> <span id="modalPerusahaan"></span></p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
            <p><strong>Jam:</strong> <span id="modalJam"></span></p>
            <p><strong>Pesan:</strong></p>
            <p id="modalPesan"></p>

            <a id="modalLink" href="#" target="_blank" class="modal-link">
                Buka Link Meeting
            </a>

            <button class="modal-close" id="closeModal">Tutup</button>
        </div>
    </div>

</body>

</html>