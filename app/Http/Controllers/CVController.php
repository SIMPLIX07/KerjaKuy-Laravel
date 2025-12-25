<?php

namespace App\Http\Controllers;

use App\Models\CVS;
use Illuminate\Http\Request;

class CVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'umur' => 'required|integer',
            'kontak' => 'required',
            'title' => 'required',
            'subtitle' => 'nullable',
            'tentang_saya' => 'nullable',

            'pendidikan' => 'array|max:3',
            'pendidikan.*.universitas' => 'required',
            'pendidikan.*.jurusan' => 'required',
            'pendidikan.*.pendidikan' => 'required',

            'skill' => 'array|max:3',
            'skill.*.skill' => 'required',
            'skill.*.kemampuan' => 'required|integer|min:1|max:100',

            'pengalaman' => 'array|max:3',
            'pengalaman.*.pengalaman' => 'required',
            'pengalaman.*.durasi' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $cv = Cv::create([
                'user_id' => auth()->id(),
                'umur' => $request->umur,
                'tentang_saya' => $request->tentang_saya,
                'kontak' => $request->kontak,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);

            foreach ($request->pendidikan ?? [] as $item) {
                $cv->pendidikans()->create($item);
            }

            foreach ($request->skill ?? [] as $item) {
                $cv->skills()->create($item);
            }

            foreach ($request->pengalaman ?? [] as $item) {
                $cv->pengalamans()->create($item);
            }
        });

        return back()->with('success', 'CV berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(CVS $cVS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CVS $cVS)
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
                'subtitle'
            ]));

            $cv->pendidikans()->delete();
            $cv->skills()->delete();
            $cv->pengalamans()->delete();

            foreach ($request->pendidikan ?? [] as $item) {
                $cv->pendidikans()->create($item);
            }

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
    public function destroy(CVS $cVS)
    {
        //
    }
}
