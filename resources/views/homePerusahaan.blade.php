<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy</title>

    
    <link rel="stylesheet" href="/assets/HomePelamar/style.css" />
    <link rel="stylesheet" href="/assets/homePerusahaan/homePerusahaan.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="cstm-navbar">
        <div class="cstm-nav-container">
            <div class="nav-logo">
                <img src="/assets/HomePelamar/asset/KerjaKuy.png" class="logo-img" />
                <a href="/" class="brand-text">KerjaKuy</a>
            </div>

            <div class="cstm-nav-menu">
                <a href="/home-perusahaan" class="cstm-nav-link active">Lowongan Anda</a>
                <a href="/karyawanPerusahaan" class="cstm-nav-link">Karyawan</a>
                <a href="/perusahaan/wawancara" class="cstm-nav-link">Wawancara</a>
            </div>

            <div class="cstm-nav-user">
                <a href="{{ route('perusahaan.settings') }}" class="cstm-user-margin"
                    style="color:white; text-decoration:none;">
                    {{ session('perusahaan_nama') }}
                </a>
            </div>
        </div>
    </nav>

    <div class="search-bar-container">
    {{-- Tambahkan Form di sini --}}
    <form action="/home-perusahaan" method="GET" class="search-form-wrapper">
        <input type="text" 
               name="q" 
               placeholder="Cari posisi lowongan" 
               class="search-input" 
               value="{{ request('q') }}"> {{-- Agar teks pencarian tidak hilang setelah diklik --}}
        
        <button type="submit" class="search-button">Cari</button>
    </form>
</div>

    @if ($lowongans->isEmpty())
    <!-- kondisi tidak ada lowongan -->
    <div class="tambah-lowongan-wrapper">
        <a href="/lowongan/tambah" class="btn-tambah-lowongan">
            Tambah Lowongan
        </a>
    </div>
    @else
    <!-- kondisi ada lowongan -->
    <div class="lowongan-container">
        @foreach ($lowongans as $lowongan)
        <a href="{{ route('perusahaan.lowongan.detail', $lowongan->id) }}" style="text-decoration: none; color: inherit;">
            <div class="lowongan-card">
                <h4>{{ $lowongan->posisi_pekerjaan }}</h4>

                <p class="desc">
                    {{ $lowongan->deskripsi_singkat }}
                </p>

                <div class="info">
                    <span>Pelamar:
                        <strong>{{ $lowongan->lamarans_count }}</strong>
                    </span>
                </div>

                <div class="tanggal">
                    {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai)->format('d-m-Y') }}
                    –
                    {{ \Carbon\Carbon::parse($lowongan->tanggal_berakhir)->format('d-m-Y') }}
                </div>
            </div>
        </a>
        @endforeach

        @if(!request('q'))
            <a href="/lowongan/tambah" class="btn-plus"><span>+</span></a>
        @endif
    </div>
    @endif


    <script>
        const searchInput = document.querySelector('.search-input');
        const searchForm = document.querySelector('.search-form-wrapper');

        searchInput.addEventListener('input', function() {
            if (this.value === '') {
                searchForm.submit(); 
            }
        });
    </script>



</body>

</html>