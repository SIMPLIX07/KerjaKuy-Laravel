<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cvs = Cv::with('pelamar')->get();
        return view('indexCv', compact('cvs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelamarId = session('pelamar_id');

    if (!$pelamarId) {
        return redirect('/login')->withErrors('Silakan login dulu');
    }

    $pelamar = Pelamar::findOrFail($pelamarId);
        
        return view('cv.tambahCv', compact('pelamar'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return redirect('/login');
        }

        $request->validate([
            'umur'         => 'required|integer',
            'kontak'       => 'required',
            'title'        => 'required',
            'subtitle'     => 'required',
            'tentang_saya' => 'required',

            'universitas'  => 'required',
            'jurusan'      => 'required',
            'pendidikan'   => 'required',

            'skill'        => 'array|max:3',
            'pengalaman'   => 'array|max:3',
        ]);

        try {
            DB::beginTransaction();

            $cv = Cv::create([
                'pelamar_id'   => $pelamarId,
                'umur'         => $request->umur,
                'tentang_saya' => $request->tentang_saya,
                'kontak'       => $request->kontak,
                'title'        => $request->title,
                'subtitle'     => $request->subtitle,
                'universitas'  => $request->universitas,
                'jurusan'      => $request->jurusan,
                'pendidikan'   => $request->pendidikan,
            ]);

            foreach ($request->skill ?? [] as $item) {
                if (!empty($item['skill']) && !empty($item['kemampuan'])) {
                    $cv->skills()->create($item);
                }
            }

            foreach ($request->pengalaman ?? [] as $item) {
                if (!empty($item['pengalaman']) && !empty($item['durasi'])) {
                    $cv->pengalamans()->create($item);
                }
            }

            DB::commit();

            return redirect('/cv')->with('success', 'CV berhasil disimpan');

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil CV berdasarkan ID beserta relasi skill dan pengalaman
        $cv = Cv::with(['pelamar', 'skills', 'pengalamans'])->findOrFail($id);
        return view('cv.detail', compact('cv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cv = Cv::with(['skills', 'pengalamans'])->findOrFail($id);
        return view('cv/editCv', compact('cv'));
    }


    public function update(Request $request, $id)
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return redirect('/login');
        }

        $request->validate([
            'umur'         => 'required|integer',
            'kontak'       => 'required',
            'title'        => 'required',
            'subtitle'     => 'required',
            'tentang_saya' => 'required',

            'universitas'  => 'required',
            'jurusan'      => 'required',
            'pendidikan'   => 'required',

            'skill'        => 'array|max:3',
            'pengalaman'   => 'array|max:3',
        ]);

        try {
            DB::beginTransaction();

            // ambil CV lama (pastikan milik pelamar yang login)
            $cv = Cv::where('id', $id)
                    ->where('pelamar_id', $pelamarId)
                    ->firstOrFail();

            // update data utama CV
            $cv->update([
                'umur'         => $request->umur,
                'tentang_saya' => $request->tentang_saya,
                'kontak'       => $request->kontak,
                'title'        => $request->title,
                'subtitle'     => $request->subtitle,
                'universitas'  => $request->universitas,
                'jurusan'      => $request->jurusan,
                'pendidikan'   => $request->pendidikan,
            ]);

            // hapus skill lama
            $cv->skills()->delete();

            // simpan skill baru
            foreach ($request->skill ?? [] as $item) {
                if (!empty($item['skill']) && !empty($item['kemampuan'])) {
                    $cv->skills()->create([
                        'skill'     => $item['skill'],
                        'kemampuan' => $item['kemampuan'],
                    ]);
                }
            }

            // hapus pengalaman lama
            $cv->pengalamans()->delete();

            // simpan pengalaman baru
            foreach ($request->pengalaman ?? [] as $item) {
                if (!empty($item['pengalaman']) && !empty($item['durasi'])) {
                    $cv->pengalamans()->create([
                        'pengalaman' => $item['pengalaman'],
                        'durasi'     => $item['durasi'],
                    ]);
                }
            }

            DB::commit();

            return redirect('/cv')->with('success', 'CV berhasil diperbarui');

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage()); // hapus setelah debug
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelamarId = session('pelamar_id');

        if (!$pelamarId) {
            return redirect('/login');
        }

        try {
            DB::beginTransaction();

            $cv = Cv::where('id', $id)
                    ->where('pelamar_id', $pelamarId)
                    ->firstOrFail();

            $cv->skills()->delete();
            $cv->pengalamans()->delete();

            $cv->delete();

            DB::commit();

            return redirect('/cv')->with('success', 'CV berhasil dihapus');

        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect('/cv')->withErrors([
                'error' => 'Gagal menghapus CV'
            ]);
        }
    }
}
