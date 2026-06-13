<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lowongan</title>

    <link rel="stylesheet" href="/assets/lowongan/tambahLowongan.css">
</head>

<body>

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Tambah lowongan</h2>
            
            @if ($errors->any())
            <div style="background:#ffecec; color:#b00000; padding:15px; border-radius:8px; margin-bottom:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="/lowongan/tambah" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tentang Pekerjaan -->
                <h4>Tentang Pekerjaan</h4>

                <div class="grid-3">
                    <div>
                        <label>Kategori Pekerjaan</label>
                        <input type="text" name="kategori">
                    </div>
                    <div>
                        <label>Posisi Pekerjaan</label>
                        <input type="text" name="posisi">
                    </div>
                    <div>
                        <label>Jenis Pekerjaan</label>
                        <select name="jenis" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Full-time" {{ old('jenis') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('jenis') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Kontrak" {{ old('jenis') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                        </select>
                    </div>
                </div>

                <label>Gaji</label>
                <input type="text" name="gaji">

                <label>Deskripsi Singkat</label>
                <input type="text" name="deskripsi_singkat">

                <label>Deskripsi Pekerjaan</label>
                <textarea name="deskripsi"></textarea>

                <label>Syarat</label>
                <textarea name="syarat"></textarea>

                <!-- Syarat & Kualifikasi -->
                <h4>Syarat & Kualifikasi</h4>

                <div class="grid-2">
                    <div>
                        <label>Minimal Pendidikan</label>
                        <input type="text" name="pendidikan" placeholder="Contoh: Minimal S1 Teknik Informatika / Ilmu Komputer" value="{{ old('pendidikan') }}">
                    </div>
                    <div>
                        <label>Minimal Pengalaman</label>
                        <input type="text" name="pengalaman" placeholder="Contoh: Minimal 1 tahun di posisi terkait" value="{{ old('pengalaman') }}">
                    </div>
                </div>

                <label>Keahlian Teknis Utama (Pisahkan dengan koma)</label>
                <input type="text" name="keahlian_teknis" placeholder="Contoh: PHP (Laravel), Node.js (Express), PostgreSQL" value="{{ old('keahlian_teknis') }}">

                <!-- Lokasi -->
                <h4>Lokasi Pekerjaan</h4>

                <div class="grid-3">
                    <input type="text" name="provinsi" placeholder="Provinsi">
                    <input type="text" name="kota" placeholder="Kabupaten/Kota">
                    <input type="text" name="kecamatan" placeholder="Kecamatan">
                </div>

                <label>Alamat Lengkap</label>
                <textarea name="alamat"></textarea>

                <!-- Waktu -->
                <h4>Waktu lowongan</h4>

                <div class="grid-2">
                    <div>
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai">
                    </div>
                    <div>
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="tanggal_akhir">
                    </div>
                </div>



                <button type="submit" class="btn-submit">Buat</button>
            </form>
        </div>
    </div>
</body>

</html>