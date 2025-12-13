<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/settingPerusahaan/settingPerusahaan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="d-flex" style="min-height: 100vh;">

        {{-- Sisi Kiri: Sidebar Pengaturan --}}
        <div class="cstm-sidebar p-4 text-white">
            <h4 class="mb-4">Pengaturan</h4>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link cstm-nav-link active" href="{{ route('perusahaan.settings') }}" role="tab"
                    aria-selected="true">
                    <i class="fas fa-user-circle me-2"></i> Akun
                </a>
                <a class="nav-link cstm-nav-link" href="#" role="tab" aria-selected="false">
                    <i class="fas fa-shield-alt me-2"></i> Keamanan
                </a>
            </div>
        </div>

        {{-- Sisi Kanan: Konten Akun --}}
        <div class="cstm-content flex-grow-1 p-5 bg-white">
            <h2 class="mb-4">Akun</h2>

            <hr class="mt-0 mb-5 cstm-divider">

            {{-- Bagian Profil dan Tombol Edit --}}
            <div class="d-flex justify-content-between align-items-center mb-4">

                {{-- Foto Profil dan Teks --}}
                <div class="d-flex align-items-center">
                    <div class="cstm-avatar-circle me-3"></div>
                    <label class="form-label fw-bold m-0">Foto Profil</label>
                </div>

                {{-- Tombol Edit (Ikon Pensil) --}}
                <button id="btnEditProfile" class="btn btn-link p-0" style="text-decoration: none;">
                    <img src="/assets/settingPerusahaan/img/edit black.png" alt="Edit" class="cstm-edit-icon">
                </button>
            </div>

            <hr class="mt-5 mb-5 cstm-divider">

            {{-- Bagian Display Data --}}
            <form>

                {{-- NAMA PERUSAHAAN --}}
                <div class="mb-3 cstm-field-group">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control cstm-display-input" readonly
                        value="{{ $perusahaan->nama_perusahaan ?? '-' }}">
                </div>

                {{-- EMAIL --}}
                <div class="mb-3 cstm-field-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control cstm-display-input" readonly
                        value="{{ $perusahaan->email ?? '-' }}">
                </div>

                {{-- NO. TELPON --}}
                <div class="mb-3 cstm-field-group">
                    <label for="telepon" class="form-label">No. Telpon</label>
                    <input type="text" class="form-control cstm-display-input" readonly
                        value="{{ $perusahaan->telepon ?? '-' }}">
                </div>

                {{-- NPWP --}}
                <div class="mb-3 cstm-field-group">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input type="text" class="form-control cstm-display-input" readonly
                        value="{{ $perusahaan->npwp ?? '-' }}">
                </div>

                {{-- LOKASI --}}
                <div class="mb-4 cstm-field-group">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control cstm-display-input" readonly
                        value="{{ $perusahaan->alamat ?? '-' }}">
                </div>

            </form>

            {{-- Tombol Keluar (Logout) --}}
            <form action="{{ route('perusahaan.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link text-danger p-0 cstm-link-keluar">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>
    


    {{-- FORM EDIT DATA PERUSAHAAN --}}

    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true"
         data-success-message="{{ session('success') }}"
         data-has-errors="{{ $errors->any() ? 'true' : 'false' }}">
        
        {{-- MENGGUNAKAN CLASS CSTM-WIDE-MODAL UNTUK LEBAR --}}
        <div class="modal-dialog modal-dialog-centered cstm-wide-modal"> 
            <div class="modal-content">
                
                {{-- HEADER: Jarak Atas dan Samping Lebar --}}
                <div class="modal-header border-0 px-5 pt-5 pb-0 mb-4"> 
                    <h5 class="modal-title fw-bold" id="editDataModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('perusahaan.settings.update') }}" method="POST">
                    @csrf
                    
                    {{-- BODY: Jarak Samping Lebar --}}
                    <div class="modal-body pt-0 px-5"> 
                        
                        {{-- NAMA PERUSAHAAN --}}
                        <div class="mb-4"> {{-- GUNAKAN mb-4 UNTUK JARAK BAWAH YANG LEBIH BESAR --}}
                            <label for="nama_perusahaan" class="form-label cstm-modal-label-jarak">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}">
                            @error('nama_perusahaan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-4"> {{-- GUNAKAN mb-4 UNTUK JARAK BAWAH YANG LEBIH BESAR --}}
                            <label for="email" class="form-label cstm-modal-label-jarak">Email</label>
                            <input type="email" class="form-control" name="email" 
                                   value="{{ old('email', $perusahaan->email) }}">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- NO. TELPON --}}
                        <div class="mb-4"> {{-- GUNAKAN mb-4 UNTUK JARAK BAWAH YANG LEBIH BESAR --}}
                            <label for="telepon" class="form-label cstm-modal-label-jarak">No. Telpon</label>
                            <input type="text" class="form-control" name="telepon" 
                                   value="{{ old('telepon', $perusahaan->telepon) }}">
                            @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        {{-- LOKASI --}}
                        <div class="mb-4"> {{-- GUNAKAN mb-4 UNTUK JARAK BAWAH YANG LEBIH BESAR --}}
                            <label for="lokasi" class="form-label cstm-modal-label-jarak">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" 
                                   value="{{ old('lokasi', $perusahaan->alamat) }}">
                            @error('lokasi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>
                    
                    {{-- FOOTER: Jarak Bawah dan Samping Lebar --}}
                    <div class="modal-footer border-0 px-5 pb-5 pt-0 justify-content-end"> 
                        <button type="button" class="btn cstm-btn-batal" data-bs-dismiss="modal">Batal</button> 
                        <button type="submit" class="btn cstm-btn-simpan-teal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-bold">
                    </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/settingPerusahaan/settingPerusahaan.js"></script>
</body>

</html>