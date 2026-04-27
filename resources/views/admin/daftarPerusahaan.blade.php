<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perusahaan - Admin KerjaKuy</title>
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
        
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            align-items: flex-end;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        
        .filter-group input,
        .filter-group select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #1f9d8f;
            box-shadow: 0 0 5px rgba(31, 157, 143, 0.3);
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: scale(1.02);
        }
        
        .btn-filter {
            background-color: #1f9d8f;
            color: white;
        }
        
        .btn-reset {
            background-color: #999;
            color: white;
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
        
        .btn-action {
            display: inline-block;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
            margin-right: 5px;
        }
        
        .btn-view {
            background-color: #0aa8d8;
            color: white;
        }
        
        .btn-view:hover {
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
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
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
        <h2>Daftar Semua Perusahaan</h2>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('admin.daftarPerusahaan') }}" method="GET">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="search">Cari (Nama / Email):</label>
                        <input type="text" id="search" name="search" placeholder="Ketik nama atau email..." value="{{ request('search') }}">
                    </div>
                    
                    <div class="filter-group">
                        <label for="status">Filter Status:</label>
                        <select id="status" name="status">
                            <option value="">-- Semua Status --</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-filter">Cari</button>
                        <a href="{{ route('admin.daftarPerusahaan') }}" class="btn btn-reset">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Table -->
        @if ($perusahaan->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaan as $index => $p)
                            <tr>
                                <td>{{ ($perusahaan->currentPage() - 1) * 15 + $index + 1 }}</td>
                                <td><strong>{{ $p->nama_perusahaan }}</strong></td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->telepon }}</td>
                                <td>
                                    @if ($p->status_verifikasi === 'pending')
                                        <span class="status-badge status-pending">Menunggu</span>
                                    @elseif ($p->status_verifikasi === 'verified')
                                        <span class="status-badge status-verified">Terverifikasi</span>
                                    @else
                                        <span class="status-badge status-rejected">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.detailPerusahaan', $p->id) }}" class="btn-action btn-view">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="no-data">Tidak ada data perusahaan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                {{ $perusahaan->links() }}
            </div>
        @else
            <div class="table-container">
                <div class="no-data">
                    <p style="font-size: 16px;">Tidak ada perusahaan yang sesuai dengan filter Anda</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
