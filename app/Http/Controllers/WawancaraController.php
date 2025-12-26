<?php

namespace App\Http\Controllers;

use App\Models\Wawancara;
use App\Models\Lamaran;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return redirect('/login/pelamar');
        }

        $wawancarans = Wawancara::with(['lowongan.perusahaan'])
            ->where('pelamar_id', $pelamarId)
            ->whereIn('status', ['proses', 'selesai'])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('wawancaraPelamar.wawancara', compact('wawancarans'));
    }

    public function indexPerusahaan()
    {
        $perusahaanId = session('perusahaan_id');

        if (!$perusahaanId) {
            return redirect('/login/perusahaan');
        }

        $wawancarans = Wawancara::with(['lowongan', 'pelamar'])
            ->where('perusahaan_id', $perusahaanId)
            ->whereIn('status', ['proses', 'selesai'])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('perusahaan.wawancara', compact('wawancarans'));
    }


    public function terima($id)
    {
        $wawancara = Wawancara::with('lowongan')->findOrFail($id);

        $wawancara->update(['status' => 'selesai']);

        Lamaran::where('pelamar_id', $wawancara->pelamar_id)
            ->where('lowongan_id', $wawancara->lowongan_id)
            ->update(['status' => 'diterima']);

        Karyawan::create([
            'id_pelamar'     => $wawancara->pelamar_id,
            'id_lowongan'    => $wawancara->lowongan_id,
            'id_perusahaan'  => $wawancara->perusahaan_id,
            'kategori_pekerjaan' => $wawancara->lowongan->kategori_pekerjaan,
            'posisi'         => $wawancara->lowongan->posisi_pekerjaan,
            'tanggal_mulai'  => now(),
            'status_karyawan' => 'aktif'
        ]);

        return response()->json(['message' => 'Pelamar diterima']);
    }

    public function tolak($id)
    {
        DB::transaction(function () use ($id) {

            $wawancara = Wawancara::findOrFail($id);

            $wawancara->update([
                'status' => 'selesai'
            ]);

            Lamaran::where('pelamar_id', $wawancara->pelamar_id)
                ->where('lowongan_id', $wawancara->lowongan_id)
                ->update([
                    'status' => 'ditolak'
                ]);
        });

        return response()->json([
            'message' => 'Pelamar ditolak'
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wawancara $wawancara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wawancara $wawancara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wawancara $wawancara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wawancara $wawancara)
    {
        //
    }
}
