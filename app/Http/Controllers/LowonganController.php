<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

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
            $namaGambar = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/lowongan', $namaGambar);
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

    public function listPelamar()
    {
        $lowongans = Lowongan::with('perusahaan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact('lowongans'));
    }
}
