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
        return view('indexCv');
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
    public function show(Cv $cVS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cv $cVS)
    {
        //
    }

    public function update(Request $request, Cv $cv)
    {
        DB::transaction(function () use ($request, $cv) {

            $cv->update($request->only([
                'umur',
                'tentang_saya',
                'kontak',
                'title',
                'subtitle',
                'universitas',
                'jurusan',
                'pendidikan'
            ]));

            $cv->skills()->delete();
            $cv->pengalamans()->delete();

            foreach ($request->skill ?? [] as $item) {
                $cv->skills()->create($item);
            }

            foreach ($request->pengalaman ?? [] as $item) {
                $cv->pengalamans()->create($item);
            }
        });

        return back()->with('success', 'CV berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cv $cVS)
    {
        //
    }
}
