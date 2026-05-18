<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjaKuy - History Lamaran</title>

    <link rel="stylesheet" href="/assets/HomePelamar/style.css" />
    <link rel="stylesheet" href="/assets/wawancaraPerusahaan/wawancara.css">
    <link rel="stylesheet" href="/assets/LamaranAnda/Lamaran.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="cstm-navbar">
        <div class="cstm-nav-container">
            <div class="nav-logo">
                <img src="/assets/HomePelamar/asset/KerjaKuy.png" class="logo-img" />
                <a href="/" class="brand-text">KerjaKuy</a>
            </div>

            <div class="cstm-nav-menu">
                <a href="/home-perusahaan" class="cstm-nav-link">Lowongan Anda</a>
                <a href="/karyawanPerusahaan" class="cstm-nav-link">Karyawan</a>
                <a href="/perusahaan/wawancara" class="cstm-nav-link">Wawancara</a>
                <a href="{{ route('perusahaan.history') }}" class="cstm-nav-link active">History</a>
            </div>

            <div class="cstm-nav-user">
                <a href="{{ route('perusahaan.settings') }}" class="cstm-user-margin" style="color:white; text-decoration:none;">
                    {{ session('perusahaan_nama') }}
                </a>
            </div>
        </div>
    </nav>

    <div class="search-bar-container"></div>

    <div class="main-grid">
        <div class="tabs-wrapper">
            <div class="tabs-container">
                <button class="tab-btn tab-active" data-tab="diterima">
                    Diterima
                </button>
                <button class="tab-btn" data-tab="ditolak">
                    Ditolak
                </button>

            </div>
        </div>

        <div class="wp-cards-container" style="grid-column: span 12;">
            @forelse ($lamarans as $lamaran)
                <div class="wp-card card-history-item"
                    data-status="{{ $lamaran->status }}"
                    data-nama="{{ $lamaran->pelamar->nama_lengkap ?? '' }}"
                    data-posisi="{{ $lamaran->lowongan->posisi_pekerjaan ?? '' }}">

                    <div class="wp-card-title">
                        {{ $lamaran->lowongan->posisi_pekerjaan ?? '-' }}
                    </div>

                    <div class="wp-card-company">
                        {{ $lamaran->pelamar->nama_lengkap ?? '-' }}
                    </div>

                    <div class="wp-card-desc">
                        @if ($lamaran->status === 'diterima')
                            Pelamar <strong>diterima</strong>.
                        @else
                            Pelamar <strong>ditolak</strong>.
                        @endif

                        @if ($lamaran->pelamar?->email)
                            <div style="margin-top: 8px; font-size: 0.95rem; color: #333;">
                                Email: {{ $lamaran->pelamar->email }}
                            </div>
                        @endif

                        @if ($lamaran->cv_id)
                            <div class="wp-link-label" style="margin-top: 8px;">
                                CV:
                                <a href="{{ route('cv.show', $lamaran->cv_id) }}" target="_blank" class="wp-link-url">
                                    Resume.pdf
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="wp-card-date">
                        {{ optional($lamaran->updated_at)->format('d M Y') }}
                    </div>

                </div>
            @empty
                <div class="empty-wrapper" id="emptyStateServer">
                    <div class="empty-card">
                        <h3>Belum ada history</h3>
                        <p>Belum ada history.</p>
                    </div>
                </div>
            @endforelse

            <div class="empty-wrapper" id="emptyState" style="display:none;">
                <div class="empty-card">
                    <h3>Belum ada history</h3>
                    <p>Belum ada history.</p>
                </div>
            </div>
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab-btn');
            const cards = document.querySelectorAll('.card-history-item');
            const emptyState = document.getElementById('emptyState');
            const emptyStateServer = document.getElementById('emptyStateServer');

            function applyFilter(activeStatus) {
                let visibleCount = 0;

                cards.forEach(card => {
                    const cocok = card.dataset.status === activeStatus;
                    card.style.display = cocok ? 'flex' : 'none';
                    if (cocok) visibleCount++;
                });

                if (emptyStateServer) emptyStateServer.style.display = 'none';
                if (emptyState) emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    tab.classList.add('tab-active');
                    applyFilter(tab.dataset.tab);
                });
            });

            const defaultTab = document.querySelector('.tab-btn.tab-active')?.dataset.tab || 'diterima';
            applyFilter(defaultTab);
        });
    </script>
</body>

</html>
