<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - {{ $lowongan->posisi_pekerjaan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/lowongan/detailLowongan.css') }}">
</head>

<body>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(function () {
                    let alert = document.getElementById('success-alert');
                    if (alert) {
                        let bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 3000);
            </script>
        @endif

        <div class="detail-wrapper">
            <div class="banner-container">
                @if($lowongan->gambar)
                    <img src="{{ asset('storage/lowongan/' . $lowongan->gambar) }}" class="banner-img">
                @else
                    <img src="/assets/default-banner.jpg" class="banner-img">
                @endif

                <div class="profile-overlay">
                    <img src="{{ $lowongan->perusahaan->foto_profil ? asset('storage/' . $lowongan->perusahaan->foto_profil) : '/assets/default-logo.png' }}"
                        class="company-logo">
                    <div class="company-info-header">
                        <h4>{{ $lowongan->perusahaan->nama_perusahaan }}</h4>
                        <p>{{ $lowongan->posisi_pekerjaan }}</p>
                    </div>
                </div>
            </div>

            <div class="meta-bar">
                <div class="meta-items">
                    <div><i class="fas fa-money-bill-wave"></i> IDR
                        {{ number_format((int) $lowongan->gaji, 0, ',', '.') }}

                    </div>
                    <div><i class="far fa-clock"></i> {{ $lowongan->jenis_pekerjaan }}</div>
                    <div><i class="fas fa-map-marker-alt"></i> {{ $lowongan->kabupaten }}, {{ $lowongan->provinsi }}
                    </div>
                </div>
                <div class="action-btns">
                    <form action="{{ route('perusahaan.lowongan.delete', $lowongan->id) }}" method="POST"
                        class="d-inline" onsubmit="return confirm('Hapus lowongan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                    <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-edit">
                        <i class="fas fa-pencil"></i>
                    </a>
                </div>
            </div>

            <div class="content-section">
                <h5>Deskripsi Singkat</h5>
                <p>• {{ $lowongan->deskripsi_singkat }}</p>
            </div>

            <div class="content-section">
                <h5>Deskripsi Pekerjaan</h5>
                <div style="color: #555;">
                    {!! nl2br(e($lowongan->deskripsi_pekerjaan)) !!}
                </div>
            </div>

            <div class="content-section">
                <h5>Syarat</h5>
                <div style="color: #555;">
                    {!! nl2br(e($lowongan->syarat)) !!}
                </div>
            </div>
        </div>

        <div class="detail-wrapper mt-4 mb-5">
            <div class="pelamar-section">
                <h4 class="mb-4 fw-bold">Pelamar</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>CV</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowongan->lamarans->whereIn('status', ['diproses', 'wawancara']) as $lamaran)
                                <tr>
                                    <td>
                                        <img src="{{ $lamaran->pelamar->foto ? asset('storage/' . $lamaran->pelamar->foto) : '/assets/default-pelamar.png' }}"
                                            class="pelamar-avatar">
                                        {{ $lamaran->pelamar->name }}
                                        
                                    </td>
                                    <td>{{ $lamaran->pelamar->email }}</td>
                                    <td>
                                        <a href="{{ route('cv.show', $lamaran->cv_id) }}"
                                            class="text-decoration-none text-success" target="_blank">
                                            Resume.pdf
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalWawancara{{ $lamaran->id }}">
                                            Wawancara
                                        </button>

                                        <form action="{{ route('lamaran.tolak', $lamaran->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Tolak lamaran ini?')">
                                                Tolak
                                            </button>
                                        </form>
                                    </td>

                                    {{-- Pop up wawancara --}}
                                    <div class="modal fade" id="modalWawancara{{ $lamaran->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('lamaran.wawancara', $lamaran->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Jadwalkan Wawancara -
                                                            {{ $lamaran->pelamar->nama_lengkap }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Tanggal Wawancara</label>
                                                            <input type="date" name="tanggal" class="form-control" required>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label>Jam Mulai</label>
                                                                <input type="time" name="jam_mulai" class="form-control"
                                                                    required>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label>Jam Selesai</label>
                                                                <input type="time" name="jam_selesai" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Link Wawancara (Zoom/GMeet)</label>
                                                            <input type="url" name="link_meet" class="form-control"
                                                                placeholder="https://..." required>
                                                        </div>

                                                        <div class="alert alert-info py-2" style="font-size: 0.85rem;">
                                                            <i class="fas fa-info-circle me-1"></i> Pelamar akan menerima
                                                            pesan otomatis:
                                                            <br><em>"Kami tertarik dengan CV kamu, ditunggu di wawancara
                                                                nanti ya"</em>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Kirim
                                                            Undangan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada pelamar untuk lowongan
                                        ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>