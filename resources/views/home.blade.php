<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KerjaKuy</title>

  <link rel="stylesheet" href="/assets/HomePelamar/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

  <!-- NAVBAR -->
  <nav class="cstm-navbar">
    <div class="cstm-nav-container">
      <div class="nav-logo">
        <img src="/assets/HomePelamar/asset/KerjaKuy.png" alt="Kerjakuy Logo" class="logo-img" />
        <a href="/" class="brand-text">KerjaKuy</a>
      </div>

      <div class="cstm-nav-menu">
        <a href="/home-pelamar" class="cstm-nav-link active">Lowongan Kerja</a>
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

  <!-- SEARCH BAR -->
  <div class="search-bar-container">
    <div>
      <input type="text" placeholder="Cari pekerjaan" class="search-input" />
      <input type="text" placeholder="Pilih Bidang" class="search-input" />
      <input type="text" placeholder="Cari Lokasi" class="search-input" />
      <button class="search-button">Cari</button>
    </div>
  </div>

  <!-- LIST LOWONGAN -->
  <div class="container my-5 d-flex flex-wrap justify-content-center gap-4">

    @forelse ($lowongans as $job)
      <div class="shadow-sm h-100 position-relative" style="width: 25rem">
        <div class="card-job">

          <!-- COMPANY -->
          <div class="card-company">
            <img
              src="{{ $job->perusahaan->foto_profil
                ? asset('storage/perusahaan/profil/' . $job->perusahaan->foto_profil)
                : 'https://via.placeholder.com/50' }}"
              alt="Logo Perusahaan">

            <div>
              <h5>{{ $job->posisi_pekerjaan }}</h5>
              <p>{{ $job->perusahaan->nama_perusahaan }}</p>
            </div>
          </div>

          <!-- DESKRIPSI -->
          <p>
            {{ $job->deskripsi_singkat }}
          </p>

          <!-- LOKASI -->
          <p>
            {{ $job->kabupaten }}, {{ $job->provinsi }}
          </p>

          <!-- BUTTON LAMAR -->
          <a href="/lamar/{{ $job->id }}" class="btn-lamar btn-sm">
            Lamar
          </a>

        </div>
      </div>
    @empty
      <p class="text-center">Belum ada lowongan tersedia.</p>
    @endforelse

  </div>

</body>
</html>
