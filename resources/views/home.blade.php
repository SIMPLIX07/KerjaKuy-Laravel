<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy</title>

    <link rel="stylesheet" href="/assets/HomePelamar/style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>

<body>
    <nav class="cstm-navbar">
        <div class="cstm-nav-container">
            <div class="nav-logo">
                <img src="/assets/HomePelamar/asset/KerjaKuy.png" alt="Kerjakuy Logo" class="logo-img" />
                <a href="/" class="brand-text">KerjaKuy</a>

            </div>

            <div class="cstm-nav-menu">
                <a href="#" class="cstm-nav-link active">Lowongan Kerja</a>
                <a href="/lamaran-anda" class="cstm-nav-link">Lamaran anda</a>
                <a href="/wawancara" class="cstm-nav-link">Wawancara</a>
            </div>

            <div class="cstm-nav-user">
                <a href="{{ route('pelamar.settings') }}" class="cstm-user-margin"
                    style="color:white; text-decoration:none;">
                    {{ session('pelamar_nama') }}
                </a>


            </div>

        </div>
    </nav>

    <div class="search-bar-container">
        <div class="">
            <input type="text" placeholder="Cari pekerjaan" class="search-input" />

            <input type="text" placeholder="Pilih Bidang" class="search-input" />
            <input type="text" placeholder="Cari Lokasi" class="search-input" />

            <button class="search-button">Cari</button>
        </div>
    </div>


    <img src="" alt="">

    <div class="container my-5 d-flex flex-wrap justify-content-center gap-4">
        @foreach ($lowongans as $lowongan)
        <a href="{{ route('lowongan.detail', $lowongan->id) }}" class="job-link">
            <div div class="shadow-sm h-100 position-relative" style="width: 25rem">
                <div class="card-job">
                    <div class="card-company">
                        <div class="avatar">
                            <img src="{{ asset('storage/' . $lowongan->perusahaan->foto_profil) }}" alt="">
                        </div>
                        <div>
                            <h5 class="">{{ $lowongan->posisi_pekerjaan }}</h5>
                            <p class="">
                                {{ $lowongan->perusahaan->nama_perusahaan }}
                            </p>
                        </div>
                    </div>
                    <p class="">
                        {{ $lowongan->deskripsi_singkat }}
                    </p>
                    <p class="">
                        {{ $lowongan->alamat_lengkap }}
                    </p>

                    <span class="btn-lamar btn-sm">Lamar</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</body>

</html>