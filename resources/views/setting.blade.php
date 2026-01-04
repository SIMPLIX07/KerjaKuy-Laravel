<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/menuSettings/setting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="d-flex" style="min-height: 100vh;">

        {{-- Sisi Kiri: Sidebar Pengaturan --}}
        <div class="cstm-sidebar p-4 text-white">
            <h4 class="mb-4">Pengaturan</h4>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link cstm-nav-link active" href="{{ route('pelamar.settings') }}" role="tab">
                    <i class="fas fa-user-circle me-2"></i> Akun
                </a>
                <a class="nav-link cstm-nav-link" href="{{ route('cv.index') }}" role="tab">
                    <i class="fas fa-file-alt me-2"></i> CV
                </a>
                <a class="nav-link cstm-nav-link"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#ubahPasswordModal">
                    <i class="fas fa-shield-alt me-2"></i> Keamanan
                </a>

            </div>
        </div>

        {{-- Sisi Kanan: Konten Akun --}}
        <div class="cstm-content flex-grow-1 p-5 bg-white">
            @if (session('success_password'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_password') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <h2 class="mb-4">Akun</h2>
            <hr class="mt-0 mb-5 cstm-divider">

            {{-- Bagian Profil dan Tombol Edit --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="cstm-avatar-circle me-3">
                        <img src="{{ $pelamar->foto_profil ? asset('storage/profil/'.$pelamar->foto_profil) : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                            alt="Profile" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                    </div>
                    <label class="form-label fw-bold m-0">Foto Profil</label>
                </div>

                {{-- Tombol Edit (Ikon Pensil) --}}
                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <img src="/assets/settingPerusahaan/img/edit black.png" alt="Edit" class="cstm-edit-icon">
                </button>
            </div>

            <hr class="mt-5 mb-5 cstm-divider">

            {{-- Bagian Display Data (Read-only) --}}
            <div class="mb-3 cstm-field-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control cstm-display-input" readonly value="{{ $pelamar->nama_lengkap }}">
            </div>

            <div class="mb-3 cstm-field-group">
                <label class="form-label">Keahlian</label>
                <input type="text" class="form-control cstm-display-input" readonly value="{{ $keahlianString }}">
            </div>

            <div class="mb-3 cstm-field-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control cstm-display-input" readonly value="{{ $pelamar->username }}">
            </div>

            <div class="mb-3 cstm-field-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control cstm-display-input" readonly value="{{ $pelamar->email }}">
            </div>

            <div class="mb-4 cstm-field-group">
                <label class="form-label">No. Telpon</label>
                <input type="text" class="form-control cstm-display-input" readonly value="{{ $pelamar->no_telp ?? '-' }}">
            </div>

            {{-- Tombol Keluar (Logout) --}}
            <form action="{{ route('pelamar.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link text-danger p-0 cstm-link-keluar">
                    <i class="fas fa-sign-out-alt me-2"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT DATA PELAMAR --}}
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered cstm-wide-modal">
            <div class="modal-content">
                <div class="modal-header border-0 px-5 pt-5 pb-0 mb-4">
                    <h5 class="modal-title fw-bold">Edit Data Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pelamar.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-0 px-5">
                        {{-- Upload Foto --}}
                        <div class="mb-4 text-center">
                            <div class="cstm-avatar-circle mx-auto mb-2" onclick="document.getElementById('inputFoto').click()" style="cursor: pointer;">
                                <img id="preview" src="{{ $pelamar->foto_profil ? asset('storage/profil/'.$pelamar->foto_profil) : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                                    class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                            </div>
                            <small class="text-muted">Klik lingkaran untuk ganti foto</small>
                            <input type="file" name="foto_profil" id="inputFoto" class="d-none" onchange="previewImg()">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $pelamar->nama_lengkap }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Keahlian (Pisahkan dengan koma)</label>
                            <input type="text" class="form-control" name="keahlian" value="{{ $keahlianString }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $pelamar->username }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $pelamar->email }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">No. Telpon</label>
                            <input type="text" class="form-control" name="no_telp" value="{{ $pelamar->no_telp }}">
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-5 pb-5 pt-0 justify-content-end">
                        <button type="button" class="btn cstm-btn-batal" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn cstm-btn-simpan-teal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImg() {
            const foto = document.querySelector('#inputFoto');
            const preview = document.querySelector('#preview');
            const fileReader = new FileReader();
            fileReader.readAsDataURL(foto.files[0]);
            fileReader.onload = (e) => {
                preview.src = e.target.result;
            }
        }
    </script>
    {{-- MODAL UBAH PASSWORD --}}
    <div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('pelamar.updatePassword') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password"
                                name="password_lama"
                                class="form-control @error('password_lama') is-invalid @enderror"
                                required>

                            @error('password_lama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password"
                                name="password_baru"
                                class="form-control @error('password_baru') is-invalid @enderror"
                                required>

                            @error('password_baru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                name="password_baru_confirmation"
                                class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="btn btn-danger">
                            Simpan Password
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @if ($errors->any() && session('openPasswordModal'))
    <script>
        const modal = new bootstrap.Modal(
            document.getElementById('ubahPasswordModal')
        );
        modal.show();
    </script>
    @endif

</body>

</html>