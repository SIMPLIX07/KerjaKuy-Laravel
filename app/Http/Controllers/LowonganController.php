<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Storage;

class LowonganController extends Controller
{
    public function index()
    {
        if (!session('perusahaan_id')) {
            return redirect('/login/perusahaan');
        }

        $lowongans = Lowongan::withCount('lamarans')
            ->where('perusahaan_id', session('perusahaan_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('homePerusahaan', compact('lowongans'));
    }

    public function detail($id)
    {
        $lowongan = Lowongan::with('perusahaan')->findOrFail($id);

        return view('lamar', compact('lowongan'));
    }

    public function create()
    {
        if (!session('perusahaan_id')) {
            return redirect('/login/perusahaan');
        }

        return view('/lowongan/tambahLowongan');
    }

    public function store(Request $request)
    {
        if (!session('perusahaan_id')) {
            return redirect('/login/perusahaan');
        }

        $request->validate([
            'kategori'          => 'required',
            'posisi'            => 'required',
            'jenis'             => 'required',
            'gaji'              => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi'         => 'required',
            'syarat'            => 'required',
            'provinsi'          => 'required',
            'kota'              => 'required',
            'kecamatan'         => 'required',
            'alamat'            => 'required',
            'tanggal_mulai'     => 'required|date',
            'tanggal_akhir'     => 'required|date|after_or_equal:tanggal_mulai',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '.' . $file->getClientOriginalExtension();
            // Gunakan storeAs dengan disk 'public' agar konsisten
            $file->storeAs('lowongan', $namaGambar, 'public');
        }

        Lowongan::create([
            'perusahaan_id'        => session('perusahaan_id'),
            'kategori_pekerjaan'   => $request->kategori,
            'posisi_pekerjaan'     => $request->posisi,
            'jenis_pekerjaan'      => $request->jenis,
            'gaji'                 => $request->gaji,
            'deskripsi_singkat'    => $request->deskripsi_singkat,
            'deskripsi_pekerjaan'  => $request->deskripsi,
            'syarat'               => $request->syarat,
            'provinsi'             => $request->provinsi,
            'kabupaten'            => $request->kota,
            'kecamatan'            => $request->kecamatan,
            'alamat_lengkap'       => $request->alamat,
            'tanggal_mulai'        => $request->tanggal_mulai,
            'tanggal_berakhir'     => $request->tanggal_akhir,
            'gambar'               => $namaGambar,
        ]);

        return redirect('/home-perusahaan')->with('success', 'Lowongan berhasil dibuat');
    }

    public function showDetail($id)
    {
        if (!session('perusahaan_id')) {
            return redirect('/login/perusahaan');
        }


        $lowongan = Lowongan::with(['perusahaan', 'lamarans.pelamar'])
            ->findOrFail($id);


        return view('perusahaan.detailLowongan', compact('lowongan'));
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        if ($lowongan->gambar) {
            Storage::delete('public/lowongan/' . $lowongan->gambar);
        }

        $lowongan->delete();

        return redirect('/home-perusahaan')->with('success', 'Lowongan berhasil dihapus');
    }

    public function edit($id)
    {
        if (!session('perusahaan_id')) {
            return redirect('/login/perusahaan');
        }

        $lowongan = Lowongan::findOrFail($id);
        return view('lowongan.editLowongan', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);

        $request->validate([
            'kategori'          => 'required',
            'posisi'            => 'required',
            'jenis'             => 'required',
            'gaji'              => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi'         => 'required',
            'syarat'            => 'required',
            'provinsi'          => 'required',
            'kota'              => 'required',
            'kecamatan'         => 'required',
            'alamat'            => 'required',
            'tanggal_mulai'     => 'required|date',
            'tanggal_akhir'     => 'required|date|after_or_equal:tanggal_mulai',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'kategori_pekerjaan'   => $request->kategori,
            'posisi_pekerjaan'     => $request->posisi,
            'jenis_pekerjaan'      => $request->jenis,
            'gaji'                 => $request->gaji,
            'deskripsi_singkat'    => $request->deskripsi_singkat,
            'deskripsi_pekerjaan'  => $request->deskripsi,
            'syarat'               => $request->syarat,
            'provinsi'             => $request->provinsi,
            'kabupaten'            => $request->kota,
            'kecamatan'            => $request->kecamatan,
            'alamat_lengkap'       => $request->alamat,
            'tanggal_mulai'        => $request->tanggal_mulai,
            'tanggal_berakhir'     => $request->tanggal_akhir,
        ];

        if ($request->hasFile('gambar')) {
            if ($lowongan->gambar) {
                Storage::disk('public')->delete('lowongan/' . $lowongan->gambar);
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke disk public
            $file->storeAs('lowongan', $namaGambar, 'public');

            // Masukkan nama file ke array data untuk diupdate
            $data['gambar'] = $namaGambar;
        }

        $lowongan->update($data);

        return redirect()->route('perusahaan.lowongan.detail', $lowongan->id)->with('success', 'Lowongan berhasil diperbarui');
    }

    public function listPelamar()
    {
        $lowongans = Lowongan::with('perusahaan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact('lowongans'));
    }
}
