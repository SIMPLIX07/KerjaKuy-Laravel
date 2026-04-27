<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KerjaKuy</title>
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
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #1f9d8f;
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
        
        .status-pending {
            background-color: #ffeaa7;
            color: #d63031;
        }
        
        .status-verified {
            background-color: #81c784;
            color: white;
        }
        
        .status-rejected {
            background-color: #ff6b6b;
            color: white;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        .btn-primary {
            background-color: #2bd1c9;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #1f9d8f;
        }
        
        .btn-info {
            background-color: #0aa8d8;
            color: white;
            margin-left: 5px;
        }
        
        .btn-info:hover {
            background-color: #0a96af;
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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        
        <h2>Dashboard Admin</h2>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Perusahaan</h3>
                <div class="number">{{ $totalPerusahaan }}</div>
            </div>
            <div class="stat-card">
                <h3>Menunggu Verifikasi</h3>
                <div class="number">{{ $pendingPerusahaan->total() }}</div>
            </div>
            <div class="stat-card">
                <h3>Terverifikasi</h3>
                <div class="number">{{ $verifiedPerusahaan }}</div>
            </div>
            <div class="stat-card">
                <h3>Ditolak</h3>
                <div class="number">{{ $rejectedPerusahaan }}</div>
            </div>
        </div>
        
        <h2>⏳ Perusahaan Menunggu Verifikasi</h2>
        
        @if ($pendingPerusahaan->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingPerusahaan as $index => $perusahaan)
                            <tr>
                                <td>{{ ($pendingPerusahaan->currentPage() - 1) * 10 + $index + 1 }}</td>
                                <td><strong>{{ $perusahaan->nama_perusahaan }}</strong></td>
                                <td>{{ $perusahaan->email }}</td>
                                <td>{{ $perusahaan->telepon }}</td>
                                <td>{{ $perusahaan->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.detailPerusahaan', $perusahaan->id) }}" class="btn btn-primary">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px;">Tidak ada perusahaan yang menunggu verifikasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                {{ $pendingPerusahaan->links() }}
            </div>
        @else
            <p style="text-align: center; padding: 20px; background: white; border-radius: 10px;">Tidak ada perusahaan yang menunggu verifikasi</p>
        @endif
    </div>
</body>
</html>
