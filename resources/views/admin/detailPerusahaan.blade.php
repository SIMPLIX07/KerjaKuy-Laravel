<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perusahaan - Admin KerjaKuy</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .navbar {
            background: linear-gradient(135deg, #2bd1c9 0%, #1f9d8f 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar h1 {
            font-size: 24px;
        }
        
        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .navbar-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .navbar-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .btn-logout {
            background-color: #ff6b6b;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        .btn-logout:hover {
            background-color: #ff5252;
        }
        
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #1f9d8f;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .detail-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .detail-header {
            background: linear-gradient(135deg, #2bd1c9 0%, #1f9d8f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .detail-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .detail-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .detail-body {
            padding: 30px;
        }
        
        .detail-section {
            margin-bottom: 30px;
        }
        
        .detail-section h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #1f9d8f;
            padding-bottom: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            color: #666;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .info-value {
            color: #333;
            font-size: 15px;
            font-weight: 500;
        }
        
        .file-link {
            color: #1f9d8f;
            text-decoration: none;
            font-weight: 600;
        }
        
        .file-link:hover {
            text-decoration: underline;
        }
        
        .action-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .action-section h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #1f9d8f;
            padding-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group textarea:focus {
            outline: none;
            border-color: #1f9d8f;
            box-shadow: 0 0 5px rgba(31, 157, 143, 0.3);
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s;
            text-decoration: none;
        }
        
        .btn:hover {
            transform: scale(1.02);
        }
        
        .btn-approve {
            background-color: #81c784;
            color: white;
        }
        
        .btn-approved {
            background-color: #66bb6a;
            color: white;
            cursor: not-allowed;
        }
        
        .btn-reject {
            background-color: #ff6b6b;
            color: white;
        }
        
        .btn-back {
            background-color: #999;
            color: white;
        }
        
        .status-approved {
            display: inline-block;
            background-color: #81c784;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .input-radio-group {
            display: flex;
            gap: 20px;
        }
        
        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .radio-item input[type="radio"] {
            cursor: pointer;
            width: 20px;
            height: 20px;
        }
        
        .radio-item label {
            margin: 0;
            cursor: pointer;
            font-weight: normal;
        }
        
        .reject-section {
            display: none;
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        
        .reject-section.show {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h1>KerjaKuy Admin</h1>
        <div class="navbar-links">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.daftarPerusahaan') }}">Daftar Perusahaan</a>
            <a href="{{ route('admin.historyVerifikasi') }}">History</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="btn-logout">Logout</button>
            </form>
        </div>
    </div>
    
    <!-- Content -->
    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Kembali ke Dashboard</a>
        
        <div class="detail-container">
            <div class="detail-header">
                <h2>{{ $perusahaan->nama_perusahaan }}</h2>
                <p>Detail Perusahaan</p>
            </div>
            
            <div class="detail-body">
                <!-- Info Dasar -->
                <div class="detail-section">
                    <h3>Informasi Dasar</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nama Perusahaan</span>
                            <span class="info-value">{{ $perusahaan->nama_perusahaan }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $perusahaan->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Telepon</span>
                            <span class="info-value">{{ $perusahaan->telepon }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">NPWP</span>
                            <span class="info-value">{{ $perusahaan->npwp }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">{{ $perusahaan->alamat ?? 'Belum diisi' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Pendaftaran</span>
                            <span class="info-value">{{ $perusahaan->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Dokumen -->
                <div class="detail-section">
                    <h3>📄 Dokumen</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Sertifikat</span>
                            @if ($perusahaan->sertifikat)
                                <a href="{{ asset('storage/' . $perusahaan->sertifikat) }}" target="_blank" class="file-link">📥 Download Sertifikat</a>
                            @else
                                <span class="info-value">Belum ditambahkan</span>
                            @endif
                        </div>
                        <div class="info-item">
                            <span class="info-label">Foto Profil</span>
                            @if ($perusahaan->foto_profil)
                                <a href="{{ asset('storage/' . $perusahaan->foto_profil) }}" target="_blank" class="file-link">👁️ Lihat Foto</a>
                            @else
                                <span class="info-value">Belum ditambahkan</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Status Verifikasi -->
                <div class="detail-section">
                    <h3>Status Verifikasi</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Status Saat Ini</span>
                            <span class="info-value">
                                @if ($perusahaan->status_verifikasi === 'pending')
                                    <span style="background-color: #ffeaa7; color: #d63031; padding: 5px 10px; border-radius: 15px; font-weight: 600;">⏳ Menunggu Verifikasi</span>
                                @elseif ($perusahaan->status_verifikasi === 'verified')
                                    <span style="background-color: #81c784; color: white; padding: 5px 10px; border-radius: 15px; font-weight: 600;">✓ Terverifikasi</span>
                                @else
                                    <span style="background-color: #ff6b6b; color: white; padding: 5px 10px; border-radius: 15px; font-weight: 600;">✗ Ditolak</span>
                                @endif
                            </span>
                        </div>
                        @if ($perusahaan->alasan_penolakan)
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <span class="info-label">Alasan Penolakan</span>
                                <span class="info-value" style="color: #d63031;">{{ $perusahaan->alasan_penolakan }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Aksi Verifikasi -->
                @if ($perusahaan->status_verifikasi === 'pending')
                    <div class="action-section">
                        <h3>🔧 Aksi Verifikasi</h3>
                        
                        <form action="{{ route('admin.verifikasiPerusahaan', $perusahaan->id) }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label>Pilih Tindakan:</label>
                                <div class="input-radio-group">
                                    <div class="radio-item">
                                        <input type="radio" id="status_verified" name="status_verifikasi" value="verified" required onchange="toggleRejectSection()">
                                        <label for="status_verified">✓ Verifikasi (Setujui)</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" id="status_rejected" name="status_verifikasi" value="rejected" onchange="toggleRejectSection()">
                                        <label for="status_rejected">✗ Tolak</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Section untuk alasan penolakan -->
                            <div class="reject-section" id="rejectSection">
                                <div class="form-group">
                                    <label for="alasan_penolakan">Alasan Penolakan (Wajib jika ditolak):</label>
                                    <textarea id="alasan_penolakan" name="alasan_penolakan" placeholder="Jelaskan alasan penolakan perusahaan ini..."></textarea>
                                </div>
                            </div>
                            
                            <div class="button-group">
                                <button type="submit" class="btn btn-approve">Simpan Keputusan</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-back">Batal</a>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="action-section">
                        <p style="color: #666; font-size: 14px;">
                            Perusahaan ini telah diproses. Status tidak dapat diubah.
                            @if ($perusahaan->verified_at)
                                <br>Diproses pada: {{ $perusahaan->verified_at->format('d/m/Y H:i') }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        function toggleRejectSection() {
            const rejectSection = document.getElementById('rejectSection');
            const statusRejected = document.getElementById('status_rejected');
            const alasanField = document.getElementById('alasan_penolakan');
            
            if (statusRejected.checked) {
                rejectSection.classList.add('show');
                alasanField.required = true;
            } else {
                rejectSection.classList.remove('show');
                alasanField.required = false;
                alasanField.value = '';
            }
        }
    </script>
</body>
</html>
