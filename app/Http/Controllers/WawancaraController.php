<?php

namespace App\Http\Controllers;

use App\Models\Wawancara;
use Illuminate\Http\Request;

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
            ->whereIn('status', ['akan-datang', 'diproses'])
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
            ->whereIn('status', ['akan-datang', 'diproses'])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('perusahaan.wawancara', compact('wawancarans'));
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
