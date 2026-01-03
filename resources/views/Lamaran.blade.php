<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjaKuy</title>
    <link rel="stylesheet" href="/assets/HomePelamar/style.css" />
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
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
                <a href="/lamaran-anda" class="cstm-nav-link active">Lamaran anda</a>
                <a href="/wawancara" class="cstm-nav-link">Wawancara</a>
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
            <input type="text" placeholder="Cari pekerjaan yang dilamar" class="search-input">
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
                @php
                    $uiStatus = ($lamaran->status === 'wawancara') ? 'diproses' : $lamaran->status;
                @endphp
                <div class="card" data-status="{{ $lamaran->status }}">
                    <div class="card-title">
                        {{ $lamaran->lowongan->posisi_pekerjaan }}
                    </div>

                    <div class="card-company">
                        {{ $lamaran->lowongan->perusahaan->nama_perusahaan }}
                    </div>

                    <div class="card-desc">
                        @if ($lamaran->status === 'diproses')
                            Lamaran kamu sedang diproses
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