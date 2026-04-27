<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Login Admin
    public function showLoginForm()
    {
        return view('admin.loginAdmin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Admin credentials dari config
        $adminEmail = config('admin.admin.email');
        $adminPassword = config('admin.admin.password');

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['admin_id' => 'admin', 'admin_email' => $adminEmail]);
            return redirect('/admin/dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors(['email' => 'Email atau password admin salah']);
    }

    // Dashboard Admin - List Perusahaan Menunggu Verifikasi
    public function dashboard()
    {
        $pendingPerusahaan = Perusahaan::where('status_verifikasi', 'pending')
            ->latest()
            ->paginate(10);

        $verifiedPerusahaan = Perusahaan::where('status_verifikasi', 'verified')
            ->count();

        $rejectedPerusahaan = Perusahaan::where('status_verifikasi', 'rejected')
            ->count();

        $totalPerusahaan = Perusahaan::count();

        return view('admin.dashboard', compact('pendingPerusahaan', 'verifiedPerusahaan', 'rejectedPerusahaan', 'totalPerusahaan'));
    }

    // List Semua Perusahaan dengan Filter
    public function daftarPerusahaan(Request $request)
    {
        $query = Perusahaan::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status_verifikasi', $request->status);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $perusahaan = $query->latest()->paginate(15);

        return view('admin.daftarPerusahaan', compact('perusahaan'));
    }

    // Detail Perusahaan untuk Verifikasi
    public function detailPerusahaan($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('admin.detailPerusahaan', compact('perusahaan'));
    }

    // Verifikasi Perusahaan
    public function verifikasiPerusahaan(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $request->validate([
            'status_verifikasi' => 'required|in:verified,rejected',
            'alasan_penolakan' => 'nullable|string|max:500'
        ]);

        try {
            if ($request->status_verifikasi === 'verified') {
                $perusahaan->status_verifikasi = 'verified';
                $perusahaan->verified_by = 1; // Admin ID (future: dari Users table)
                $perusahaan->verified_at = now();
                $perusahaan->alasan_penolakan = null;
                $perusahaan->save();

                return redirect()->route('admin.dashboard')
                    ->with('success', 'Perusahaan ' . $perusahaan->nama_perusahaan . ' berhasil diverifikasi!');
            } else {
                $perusahaan->status_verifikasi = 'rejected';
                $perusahaan->alasan_penolakan = $request->alasan_penolakan;
                $perusahaan->verified_by = 1; // Admin ID (future: dari Users table)
                $perusahaan->verified_at = now();
                $perusahaan->save();

                return redirect()->route('admin.dashboard')
                    ->with('warning', 'Perusahaan ' . $perusahaan->nama_perusahaan . ' ditolak.');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Halaman History Verifikasi
    public function historyVerifikasi()
    {
        $history = Perusahaan::where('status_verifikasi', '!=', 'pending')
            ->latest('verified_at')
            ->paginate(20);

        return view('admin.historyVerifikasi', compact('history'));
    }

    // Logout Admin
    public function logout()
    {
        session()->forget(['admin_id', 'admin_email']);
        return redirect('/')->with('success', 'Anda telah logout dari panel admin');
    }
}
