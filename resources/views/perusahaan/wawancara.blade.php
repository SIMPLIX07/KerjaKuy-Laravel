<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy - Wawancara</title>

    <link rel="stylesheet" href="/assets/wawancaraPerusahaan/wawancara.css">
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
        <div class="wp-cards-container" style="grid-column: span 12;">

            @forelse ($wawancarans as $wawancara)

                <div class="wp-card card-wawancara-item"
                    data-nama="{{ $wawancara->pelamar->nama_lengkap }}"
                    data-id="{{ $wawancara->id }}"
                    data-posisi="{{ $wawancara->lowongan->posisi_pekerjaan }}"
                    data-tanggal="{{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d M Y') }}"
                    data-jam="{{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}"
                    data-pesan="{{ $wawancara->pesan ?? 'Tidak ada pesan khusus.' }}"
                    data-status="{{ $wawancara->status }}">

                    <div class="wp-card-title">
                        {{ $wawancara->lowongan->posisi_pekerjaan }}
                    </div>

                    <div class="wp-card-company">
                        {{ $wawancara->pelamar->nama }}
                        </div> <div class="wp-card-desc">
                        @if ($wawancara->status === 'proses')
                            Wawancara dengan:
                            <strong>{{ $wawancara->pelamar->nama_lengkap }}</strong>
                        @elseif ($wawancara->status === 'selesai')
                            Wawancara telah selesai
                        @endif
                    </div>

                    <div class="wp-link-label">
                        Link:
                        <a href="{{ $wawancara->link_meet }}" target="_blank" class="wp-link-url">
                          {{ $wawancara->link_meet }}
                        </a>
                    </div>

                    <div class="wp-card-date">
                        {{ \Carbon\Carbon::parse($wawancara->tanggal)->format('d M Y') }}
                        • {{ $wawancara->jam_mulai }} - {{ $wawancara->jam_selesai }}
                    </div>

                </div>
            @empty
                        <div class="empty-wrapper">
                    <div class="empty-card">
                        <h3>Belum ada wawancara</h3>
                        <p>Belum ada jadwal wawancara untuk lowongan kamu.</p>
                    </div>
                </div>
            @endforelse

    </div>


    </div>

    <script src="/assets/wawancaraPerusahaan/wawancara.js"></script>
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <h3 id="modalPosisi"></h3>
            <p><strong>Pelamar:</strong> <span id="modalNama"></span></p>
            <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
            <p><strong>Jam:</strong> <span id="modalJam"></span></p>
            <p><strong>Pesan:</strong></p>
            <p id="modalPesan"></p>

            <div class="modal-actions" id="modalActions">
                <button class="btn-accept" id="btnTerima">Terima</button>
                <button class="btn-reject" id="btnTolak">Tolak</button>
            </div>

            <button class="modal-close" id="closeModal">Tutup</button>
        </div>
    </div>

</body>

</html>