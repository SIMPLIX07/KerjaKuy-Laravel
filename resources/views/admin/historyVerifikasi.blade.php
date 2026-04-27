<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Verifikasi - Admin KerjaKuy</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        h2 {
            color: #333;
            margin-bottom: 25px;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        
        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }
        
        table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-verified {
            background-color: #81c784;
            color: white;
        }
        
        .status-rejected {
            background-color: #ff6b6b;
            color: white;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }
        
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #1f9d8f;
            transition: background 0.3s;
        }
        
        .pagination a:hover {
            background-color: #1f9d8f;
            color: white;
        }
        
        .pagination .active {
            background-color: #1f9d8f;
            color: white;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }
        
        .rejection-reason {
            font-size: 13px;
            color: #d63031;
            font-weight: 500;
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
        <h2>History Verifikasi Perusahaan</h2>
        
        @if ($history->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tanggal Verifikasi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $p)
                            <tr>
                                <td>{{ ($history->currentPage() - 1) * $history->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $p->nama_perusahaan }}</strong></td>
                                <td>{{ $p->email }}</td>
                                <td>
                                    @if ($p->status_verifikasi === 'verified')
                                        <span class="status-badge status-verified">✓ Disetujui</span>
                                    @else
                                        <span class="status-badge status-rejected">✗ Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $p->verified_at ? $p->verified_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td>
                                    @if ($p->alasan_penolakan)
                                        <span class="rejection-reason">{{ $p->alasan_penolakan }}</span>
                                    @else
                                        <span style="color: #81c784;">Disetujui tanpa catatan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data">Belum ada history verifikasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                {{ $history->links() }}
            </div>
        @else
            <div class="table-container">
                <div class="no-data">
                    <p style="font-size: 16px;">Tidak ada history verifikasi perusahaan</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
