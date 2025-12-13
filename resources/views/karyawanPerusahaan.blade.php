<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy</title>

    <link rel="stylesheet" href="/assets/karyawanPerusahaan/karyawanPerusahaan.css" />
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
                <a href="/home-perusahaan" class="cstm-nav-link">Lowongan Anda</a>
                <a href="/karyawanPerusahaan" class="cstm-nav-link active">Karyawan</a>
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
        <div>
            <input type="text" placeholder="Cari kategori pekerjaan" class="search-input" />
            <button class="search-button">Cari</button>
        </div>
    </div>

    <div class="category-wrapper">
        @if ($kategori->isEmpty())
            <div class="no-data">
                <h3>Belum ada karyawan</h3>
                <p>Terima pelamar terlebih dahulu agar karyawan tampil di sini.</p>
            </div>
        @else
            @foreach ($kategori as $item)
                <div class="category-card">
                    <h4>{{ $item->kategori_pekerjaan }}</h4>
                    <p>{{ $item->jumlah }} Karyawan</p>
                    <a href="/karyawanPerusahaan/{{ $item->kategori_pekerjaan }}" class="category-btn">Lihat</a>
                </div>
            @endforeach
        @endif
    </div>


</body>

</html>