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
                    <div><i class="fas fa-money-bill-wave"></i> IDR {{ number_format((int) $lowongan->gaji, 0, ',', '.') }}

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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowongan->lamarans as $lamaran)
                                <tr>
                                    <td>
                                        <img src="{{ $lamaran->user->foto ? asset('storage/' . $lamaran->user->foto) : '/assets/default-user.png' }}"
                                            class="pelamar-avatar">
                                        {{ $lamaran->user->name }}
                                    </td>
                                    <td>{{ $lamaran->user->email }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $lamaran->cv) }}"
                                            class="text-decoration-none text-success" target="_blank">
                                            Resume.pdf
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada pelamar untuk lowongan
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