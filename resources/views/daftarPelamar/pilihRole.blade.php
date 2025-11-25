<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar sebagai</title>
    <link rel="stylesheet" href="{{ asset('assets/daftarPelamar/pilihRole.css') }}">
</head>
<body>
    <div class="registration-page">
        <h1>Daftar sebagai apa?</h1>

        <div class="card-container">
            <a href="/register/pelamar" class="role-card" id="applicant-card">
                <div class="icon-wrapper">
                    <img src="{{ asset('assets/daftarPelamar/img/rolePelamarPutih.png') }}" alt="Pelamar" class="icon-default">
                    <img src="{{ asset('assets/daftarPelamar/img/rolePelamarBiru.png') }}" alt="Pelamar Hover" class="icon-hover">
                </div>
                <h2>Pelamar</h2>
                <p>Pengguna yang akan melamar pekerjaan disuatu perusahaan</p>
            </a>

            <a href="#" class="role-card" id="company-card">
                <div class="icon-wrapper">
                    <img src="{{ asset('assets/daftarPelamar/img/rolePerusahaanPutih.png') }}" alt="Perusahaan" class="icon-default">
                    <img src="{{ asset('assets/daftarPelamar/img/rolePerusahaanBiru.png') }}" alt="Perusahaan Hover" class="icon-hover">
                </div>
                <h2>Perusahaan</h2>
                <p>Pengguna yang akan menyediakan lowongan</p>
            </a>
        </div>
    </div>
</body>
</html>