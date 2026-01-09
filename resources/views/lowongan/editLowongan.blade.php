<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan</title>
    <link rel="stylesheet" href="/assets/lowongan/tambahLowongan.css">
</head>

<body>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Edit Lowongan</h2>

            <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h4>Tentang Pekerjaan</h4>
                <div class="grid-3">
                    <div>
                        <label>Kategori Pekerjaan</label>
                        <input type="text" name="kategori" value="{{ $lowongan->kategori_pekerjaan }}">
                    </div>
                    <div>
                        <label>Posisi Pekerjaan</label>
                        <input type="text" name="posisi" value="{{ $lowongan->posisi_pekerjaan }}">
                    </div>
                    <div>
                        <label>Jenis Pekerjaan</label>
                        <input type="text" name="jenis" value="{{ $lowongan->jenis_pekerjaan }}">
                    </div>
                </div>

                <label>Gaji</label>
                <input type="text" name="gaji" value="{{ $lowongan->gaji }}">

                <label>Deskripsi Singkat</label>
                <input type="text" name="deskripsi_singkat" value="{{ $lowongan->deskripsi_singkat }}">

                <label>Deskripsi Pekerjaan</label>
                <textarea name="deskripsi">{{ $lowongan->deskripsi_pekerjaan }}</textarea>

                <label>Syarat</label>
                <textarea name="syarat">{{ $lowongan->syarat }}</textarea>

                <h4>Lokasi Pekerjaan</h4>
                <div class="grid-3">
                    <input type="text" name="provinsi" value="{{ $lowongan->provinsi }}" placeholder="Provinsi">
                    <input type="text" name="kota" value="{{ $lowongan->kabupaten }}" placeholder="Kabupaten/Kota">
                    <input type="text" name="kecamatan" value="{{ $lowongan->kecamatan }}" placeholder="Kecamatan">
                </div>

                <label>Alamat Lengkap</label>
                <textarea name="alamat">{{ $lowongan->alamat_lengkap }}</textarea>

                <h4>Waktu lowongan</h4>
                <div class="grid-2">
                    <div>
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ $lowongan->tanggal_mulai }}">
                    </div>
                    <div>
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="tanggal_akhir" value="{{ $lowongan->tanggal_berakhir }}">
                    </div>
                </div>

                <h4>Tampilan Latar</h4>
                <input type="file" name="gambar" id="input-gambar" onchange="previewImage()">

                <div class="preview">
                    @if($lowongan->gambar)
                        <img src="{{ asset('storage/lowongan/' . $lowongan->gambar) }}" id="preview-img" alt="Preview">
                    @else
                        <img src="/assets/sample-preview.png" id="preview-img" alt="Preview">
                    @endif
                </div>

                <button type="submit" class="btn-submit">Selesai</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/lowongan/editLowongan.js') }}"></script>

</body>

</html>