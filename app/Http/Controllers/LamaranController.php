<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Cv;

class LamaranController extends Controller
{
    public function insertLamaran(Request $request)
    {
        $request->validate([
            'pelamar_id'  => 'required|integer|exists:pelamars,id',
            'lowongan_id' => 'required|integer|exists:lowongans,id',
            'cv_id'       => 'required|integer|exists:cvs,id',
        ]);

        $cek = Lamaran::where('pelamar_id', $request->pelamar_id)
            ->where('lowongan_id', $request->lowongan_id)
            ->first();

        if ($cek) {
            return response()->json([
                'message' => 'Anda sudah melamar lowongan ini'
            ], 409);
        }


        $lamaran = Lamaran::create([
            'pelamar_id'  => $request->pelamar_id,
            'lowongan_id' => $request->lowongan_id,
            'cv_id'       => $request->cv_id,
            'status'      => 'proses',
        ]);

        return response()->json([
            'message' => 'Lamaran berhasil dikirim',
            'data' => $lamaran
        ], 201);
    }

    public function getCvPelamar()
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return response()->json([], 401);
        }

        return Cv::where('pelamar_id', $pelamarId)->get();
    }

    public function index()
    {
        $pelamarId = session('pelamar_id');

        $lamarans = Lamaran::with(['lowongan.perusahaan'])
            ->where('pelamar_id', $pelamarId)
            ->latest()
            ->get();

        return view('Lamaran', compact('lamarans'));
    }
}
