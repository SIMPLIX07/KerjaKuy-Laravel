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

    <script>
        fetch("/assets/HomePelamar/pekerjaan.json")
            .then((response) => response.json())
            .then((data) => {
                console.log(data); // tampilkan di console
                // contoh menampilkan posisi ke dokumen HTML
                const container = document.getElementById("list-pekerjaan");
                data.forEach((job) => {
                    const div = document.createElement("div");
                    div.innerHTML = `
      <div div class="shadow-sm h-100 position-relative" style="width: 25rem">
        <div class="card-job">
            <div class="card-company">
                <img src="https://img.freepik.com/vektor-premium/vektor-desain-logo-minimalis-abstrak-yang-kreatif-dan-elegan-untuk-semua-perusahaan-merek_1253202-137546.jpg?semt=ais_hybrid&w=740&q=80" alt="">
                <div>
                    <h5 class="">${job.posisi}</h5>
                    <p class="">
                        ${job.nama_perusahaan}
                    </p>
                </div>
            </div>
          <p class="">
            ${job.deskripsi}
          </p>
          <p class="">
            ${job.lokasi}
          </p>
          
          <a href="/lamar" class="btn-lamar btn-sm">Lamar</a>
        </div>
        </div>
      `;
                    container.appendChild(div);
                });
            })
            .catch((error) => console.error("Gagal fetch data:", error));
    </script>
</body>

</html>
