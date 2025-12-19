<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganController extends Controller
{
    public function index(){
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pekerjaan' => 'required',
            'posisi_pekerjaan'   => 'required',
            'jenis_pekerjaan'    => 'required',
            'gaji'               => 'required',
            'deskripsi_singkat'  => 'required',
            'deskripsi_pekerjaan'=> 'required',
            'syarat'             => 'required',
            'provinsi'           => 'required',
            'kabupaten'          => 'required',
            'kecamatan'          => 'required',
            'alamat_lengkap'     => 'required',
            'tanggal_mulai'      => 'required|date',
            'tanggal_berakhir'   => 'required|date',
        ]);

        Lowongan::create([
            'perusahaan_id'      => session('perusahaan_id'),
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
            'posisi_pekerjaan'   => $request->posisi_pekerjaan,
            'jenis_pekerjaan'    => $request->jenis_pekerjaan,
            'gaji'               => $request->gaji,
            'deskripsi_singkat'  => $request->deskripsi_singkat,
            'deskripsi_pekerjaan'=> $request->deskripsi_pekerjaan,
            'syarat'             => $request->syarat,
            'provinsi'           => $request->provinsi,
            'kabupaten'          => $request->kabupaten,
            'kecamatan'          => $request->kecamatan,
            'alamat_lengkap'     => $request->alamat_lengkap,
            'tanggal_mulai'      => $request->tanggal_mulai,
            'tanggal_berakhir'   => $request->tanggal_berakhir,
        ]);

        return redirect('/karyawanPerusahaan')->with('success','Lowongan berhasil dibuat');
    }
}
