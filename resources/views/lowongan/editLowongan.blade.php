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

            @if ($errors->any())
            <div style="background:#ffecec; color:#b00000; padding:15px; border-radius:8px; margin-bottom:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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
                        <select name="jenis" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Full-time" {{ (old('jenis', $lowongan->jenis_pekerjaan) == 'Full-time' || old('jenis', $lowongan->jenis_pekerjaan) == 'Fulltime' || old('jenis', $lowongan->jenis_pekerjaan) == 'Full Time') ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ (old('jenis', $lowongan->jenis_pekerjaan) == 'Part-time' || old('jenis', $lowongan->jenis_pekerjaan) == 'Parttime' || old('jenis', $lowongan->jenis_pekerjaan) == 'Part Time') ? 'selected' : '' }}>Part-time</option>
                            <option value="Kontrak" {{ old('jenis', $lowongan->jenis_pekerjaan) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                        </select>
                    </div>
                </div>

                <label>Gaji</label>
                <input type="text" name="gaji" value="{{ $lowongan->gaji }}">

                <label>Deskripsi Singkat</label>
                <input type="text" name="deskripsi_singkat" value="{{ $lowongan->deskripsi_singkat }}">

                <label>Deskripsi Pekerjaan</label>
                <textarea name="deskripsi">{{ $lowongan->deskripsi_pekerjaan }}</textarea>

                <label>Keterangan Tambahan</label>
                <textarea name="syarat" placeholder="Contoh: Bersedia ditempatkan di luar kota, memiliki laptop sendiri, dll.">{{ $lowongan->syarat }}</textarea>

                <!-- Syarat & Kualifikasi -->
                <h4>Syarat & Kualifikasi</h4>

                <div class="grid-2">
                    <div>
                        <label>Minimal Pendidikan</label>
                        <input type="text" name="pendidikan" placeholder="Contoh: Minimal S1 Teknik Informatika / Ilmu Komputer" value="{{ old('pendidikan', $lowongan->pendidikan) }}">
                    </div>
                    <div>
                        <label>Minimal Pengalaman</label>
                        <input type="text" name="pengalaman" placeholder="Contoh: Minimal 1 tahun di posisi terkait" value="{{ old('pengalaman', $lowongan->pengalaman) }}">
                    </div>
                </div>

                <label>Keahlian Teknis Utama (Pisahkan dengan koma)</label>
                <input type="text" name="keahlian_teknis" placeholder="Contoh: PHP (Laravel), Node.js (Express), PostgreSQL" value="{{ old('keahlian_teknis', $lowongan->keahlian_teknis) }}">

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

                <div class="form-actions">
                    <a href="{{ route('perusahaan.lowongan.detail', $lowongan->id) }}" class="btn-back">← Kembali</a>
                    <button type="submit" class="btn-submit">Selesai</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>