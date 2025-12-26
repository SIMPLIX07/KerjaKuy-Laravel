<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.PELAMAR_ID = {
            {
                session('pelamar_id')
            }
        };
        window.LOWONGAN_ID = {
            {
                $lowongan - > id
            }
        };
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/pageLamar/lamar.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="navbar">
            <div class="left">
                <img src="/assets/pageLamar/asset/logo.png" alt="KerjaKuyLogo">
                <label for="">KerjaKuy</label>
            </div>
            <div class="middle">
                <ul>
                    <li id="lowongan">Lowongan Kerja</li>
                    <li id="lamaran"><a href="/lamaran-anda">Lamaran Anda</a></li>
                </ul>
            </div>
            <div class="right">
                <a href="/setting">{{ session('pelamar_nama') }}</a>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="cardTop">
            <div class="back"
                style="background-image: url('{{ asset('storage/lowongan/'.$lowongan->gambar) }}')">

                <div class="seluruh">
                    <img src="{{ asset('storage/' . $lowongan->perusahaan->foto_profil) }}" alt="">
                    <div class="profile">
                        <label id="perusahaan">
                            {{ $lowongan->perusahaan->nama_perusahaan }}
                        </label>

                        <label id="posisi">
                            {{ $lowongan->posisi_pekerjaan }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="cardDown">
            <div class="top">
                <div class="tengah">
                    <img src="/assets/pageLamar/asset/gaji.png" alt="">
                    <label>
                        IDR {{ number_format($lowongan->gaji, 0, ',', '.') }}
                    </label>

                </div>
                <div class="tengah">
                    <img src="/assets/pageLamar/asset/waktu.png" alt="">
                    <label>
                        {{ $lowongan->jenis_pekerjaan }}
                    </label>

                </div>
                <div class="tengah">
                    <img src="/assets/pageLamar/asset/lokasi.png" alt="">
                    <label>
                        {{ $lowongan->kabupaten }}, {{ $lowongan->provinsi }}
                    </label>

                </div>
            </div>
            <div class="middle">
                <h2>Deskripsi Pekerjaan</h2>
                <ul class="list">
                    @foreach (explode("\n", $lowongan->deskripsi_pekerjaan) as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>

            </div>
            <div class="bottom">
                <h2>Syarat</h2>
                <ul class="list">
                    @foreach (explode("\n", $lowongan->syarat) as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>

            </div>
            <button type="button" class="button">Lamar</button>
        </div>
    </div>

    <div id="modalCv" class="modal">
        <div class="modal-content large">

            <h3>Pilih CV</h3>

            <div id="cvList" class="cv-list">
            </div>

            <div class="modal-action">
                <button id="btnKirimLamaran" disabled>Kirim Lamaran</button>
                <button id="btnTutup">Batal</button>
            </div>

        </div>
    </div>

</body>
<div id="successModal" class="popup-overlay">
    <div class="popup-box">
        <h3>Lamaran Berhasil 🎉</h3>
        <p>Lamaran kamu berhasil dikirim. Silakan menunggu proses selanjutnya.</p>
        <button id="btnOk">Lihat Lamaran</button>
    </div>
</div>

<script src="/assets/pageLamar/lamar.js"></script>

</html>